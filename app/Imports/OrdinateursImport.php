<?php

namespace App\Imports;

use App\Models\ordinateur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Carbon\Carbon;

class OrdinateursImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    private $rowCount = 0;
    private $errors = [];
    private $requiredHeadings = ['nom']; // Add other required headings here

    public function model(array $row)
    {
        if (empty($row['nom'])) {
            return null;
        }

        try {
            $this->rowCount++;

            $nom = $this->cleanData($row['nom'] ?? '');
            $numero_serie = $this->cleanData($row['numero_serie'] ?? '');

            // Check for uniqueness
            if (ordinateur::where('nom', $nom)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: L'ordinateur '{$nom}' existe déjà.";
                return null;
            }

            if (!empty($numero_serie) && ordinateur::where('numero_serie', $numero_serie)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le numéro de série '{$numero_serie}' existe déjà.";
                return null;
            }

            return new ordinateur([
                'nom' => $nom,
                'entite' => $this->cleanData($row['entite'] ?? ''),
                'sous_entite' => $this->cleanData($row['sous_entite'] ?? ''),
                'statut' => $this->validateStatut($row['statut'] ?? 'En stock'),
                'fabricant' => $this->cleanData($row['fabricant'] ?? ''),
                'modele' => $this->cleanData($row['modele'] ?? ''),
                'numero_serie' => $numero_serie,
                'reseau_ip' => $this->cleanData($row['reseau_ip'] ?? ''),
                'disque_dur' => $this->cleanData($row['disque_dur'] ?? ''),
                'os_version' => $this->cleanData($row['os_version'] ?? ''),
                'os_noyau' => $this->cleanData($row['os_noyau'] ?? ''),
                'date_dernier_inventaire' => $this->parseDate($row['date_dernier_inventaire'] ?? null),
                'derniere_date_demarrage' => $this->parseDate($row['derniere_date_demarrage'] ?? null),
                'notes' => $this->cleanData($row['notes'] ?? ''),
            ]);
        } catch (\Exception $e) {
            $this->errors[] = "Ligne {$this->rowCount}: " . $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:100',
            'numero_serie' => 'nullable|string|max:100',
            'statut' => 'nullable|string|max:50',
        ];
    }

    private function validateStatut($statut)
    {
        $validStatuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
        $statut = trim($statut);
        return in_array($statut, $validStatuts) ? $statut : 'En stock';
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;
        try {
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    private function cleanData($value)
    {
        return is_null($value) ? '' : trim($value);
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
