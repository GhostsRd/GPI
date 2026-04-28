<?php

namespace App\Imports;

use App\Models\SimCard;
use App\Models\User;
use App\Models\SimAssignment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SimCardsImport implements ToCollection
{
    public $importedCount = 0;
    public $skippedCount = 0;
    public $errors = [];

    // Column mapping: column index => field name
    private $columnMap = [];

    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) {
            Log::warning("SimCardsImport: No rows found");
            return;
        }

        // STEP 1: Read the FIRST row as headers
        $headerRow = $rows->first()->toArray();
        Log::info("SimCardsImport: Raw headers: " . json_encode($headerRow));

        // STEP 2: Map each column index to a known field
        foreach ($headerRow as $colIndex => $rawHeader) {
            $normalized = $this->normalizeHeader($rawHeader);
            $field = $this->identifyField($normalized);
            if ($field) {
                $this->columnMap[$colIndex] = $field;
            }
        }

        Log::info("SimCardsImport: Column mapping: " . json_encode($this->columnMap));

        if (empty($this->columnMap)) {
            Log::error("SimCardsImport: Could not identify any columns from headers");
            return;
        }

        // STEP 3: Process data rows (skip the first row = headers)
        $dataRows = $rows->slice(1);
        Log::info("SimCardsImport: Processing " . $dataRows->count() . " data rows");

        foreach ($dataRows as $rowIndex => $row) {
            try {
                $rowData = $row->toArray();

                // Build a named array from the column map
                $mapped = [];
                foreach ($this->columnMap as $colIndex => $fieldName) {
                    $mapped[$fieldName] = isset($rowData[$colIndex]) ? trim((string)$rowData[$colIndex]) : null;
                }

                // Phone number = required
                $phone = $mapped['phone_number'] ?? null;
                if (empty($phone)) {
                    // Fallback: try MSISDN as phone
                    $phone = $mapped['msisdn'] ?? null;
                }

                if (empty($phone)) {
                    $this->skippedCount++;
                    continue;
                }

                // ICCID / MSISDN
                $iccid = $mapped['msisdn'] ?? ('IMPORT_' . uniqid());

                // Operator
                $operator = $mapped['operator'] ?? 'Inconnu';

                // Department / Service
                $department = $mapped['service'] ?? null;

                // User lookup
                $userName = $mapped['nom_prenom'] ?? null;
                $userId = null;
                $status = 'available';

                if (!empty($userName)) {
                    $user = User::where('name', 'like', '%' . $userName . '%')->first();
                    if ($user) {
                        $userId = $user->id;
                        $status = 'assigned';
                    }
                }

                // Remarks (combine motif + responsable IT + remarques)
                $remarksParts = [];
                if (!empty($mapped['motif'])) $remarksParts[] = "Motif: " . $mapped['motif'];
                if (!empty($mapped['responsable_it'])) $remarksParts[] = "Resp IT: " . $mapped['responsable_it'];
                if (!empty($mapped['remarques'])) $remarksParts[] = $mapped['remarques'];

                // Date parsing
                $activationDate = null;
                $dateStr = $mapped['date_recuperation'] ?? null;
                if (!empty($dateStr)) {
                    try {
                        if (is_numeric($dateStr)) {
                            // Excel serial date number
                            $activationDate = Carbon::createFromTimestamp(($dateStr - 25569) * 86400);
                        } else {
                            $activationDate = Carbon::parse($dateStr);
                        }
                    } catch (\Exception $e) {
                        // Ignore date parse errors
                    }
                }

                // Create or update SIM card
                $sim = SimCard::updateOrCreate(
                    ['phone_number' => $phone],
                    [
                        'iccid' => $iccid,
                        'operator' => $operator,
                        'status' => $status,
                        'current_user_id' => $userId,
                        'department' => $department,
                        'remarks' => !empty($remarksParts) ? implode("\n", $remarksParts) : null,
                        'activation_date' => $activationDate,
                    ]
                );

                // Create assignment if user found
                if ($userId && $sim) {
                    SimAssignment::updateOrCreate(
                        ['sim_card_id' => $sim->id, 'user_id' => $userId, 'status' => 'active'],
                        ['assigned_at' => $activationDate ?? now()]
                    );
                }

                $this->importedCount++;
                Log::info("SimCardsImport: Row imported - Phone: {$phone}, Operator: {$operator}, Status: {$status}");

            } catch (\Exception $e) {
                $this->skippedCount++;
                $this->errors[] = "Ligne " . ($rowIndex + 1) . ": " . $e->getMessage();
                Log::error("SimCardsImport: Row error - " . $e->getMessage());
            }
        }

        Log::info("SimCardsImport: Done. Imported: {$this->importedCount}, Skipped: {$this->skippedCount}");
    }

    /**
     * Normalize a header string: lowercase, strip accents, trim.
     */
    private function normalizeHeader($header): string
    {
        if ($header === null) return '';
        $header = trim((string) $header);
        $header = mb_strtolower($header, 'UTF-8');
        // Remove accents
        $header = str_replace(
            ['é', 'è', 'ê', 'ë', 'à', 'â', 'ä', 'î', 'ï', 'ô', 'ö', 'ù', 'û', 'ü', 'ç', 'É', 'È', 'Ê', 'Ë', 'À', 'Â', 'Ä', 'Î', 'Ï', 'Ô', 'Ö', 'Ù', 'Û', 'Ü', 'Ç'],
            ['e', 'e', 'e', 'e', 'a', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'c', 'e', 'e', 'e', 'e', 'a', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'c'],
            $header
        );
        return $header;
    }

    /**
     * Identify what field a normalized header represents.
     */
    private function identifyField(string $header): ?string
    {
        if (empty($header)) return null;

        // Nom et Prénom
        if ($this->matches($header, ['nom et prenom', 'nom prenom', 'nom et prenoms', 'nom_et_prenom', 'nom & prenom', 'employe', 'utilisateur', 'nom complet'])) {
            return 'nom_prenom';
        }

        // Service / Département
        if ($this->matches($header, ['service', 'departement', 'department', 'direction', 'unite'])) {
            return 'service';
        }

        // Numéro de téléphone
        if ($this->matches($header, ['numero de telephone', 'numero telephone', 'numero', 'telephone', 'tel', 'n telephone', 'num tel', 'phone', 'phone_number', 'n de telephone'])) {
            return 'phone_number';
        }

        // MSISDN / ICCID
        if ($this->matches($header, ['msisdn', 'iccid', 'sim iccid', 'numero sim', 'n sim'])) {
            return 'msisdn';
        }

        // Opérateur
        if ($this->matches($header, ['operateur', 'operator', 'reseau', 'fournisseur', 'op'])) {
            return 'operator';
        }

        // Motif
        if ($this->matches($header, ['motif', 'raison', 'objet', 'cause'])) {
            return 'motif';
        }

        // Date de récupération
        if ($this->matches($header, ['date de recuperation', 'date recuperation', 'date recup', 'date', 'date activation', 'date de recup'])) {
            return 'date_recuperation';
        }

        // Responsable IT
        if ($this->matches($header, ['responsable it', 'responsable', 'resp it', 'resp. it', 'charge it', 'it'])) {
            return 'responsable_it';
        }

        // Remarques
        if ($this->matches($header, ['remarques', 'remarque', 'notes', 'observations', 'observation', 'commentaire', 'commentaires'])) {
            return 'remarques';
        }

        return null;
    }

    /**
     * Check if header contains any of the keywords.
     */
    private function matches(string $header, array $keywords): bool
    {
        foreach ($keywords as $keyword) {
            if (str_contains($header, $keyword) || $header === $keyword) {
                return true;
            }
        }
        return false;
    }
}
