<?php

namespace App\Imports;

use App\Models\Moniteur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class MoniteursImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    private $rowCount = 0;
    private $errors = [];
    private $requiredHeadings = ['nom', 'it_identification'];

    public function model(array $row)
    {
        if (empty($row['nom']) && empty($row['it_identification'])) {
            return null;
        }

        try {
            $this->rowCount++;

            // Support both 'nom' (standard) and 'it_identification' (legacy template)
            $nom = $this->cleanData($row['nom'] ?? $row['it_identification'] ?? '');
            $numero_serie = $this->cleanData($row['numero_serie'] ?? $row['s_n'] ?? '');

            // Check for uniqueness
            if (Moniteur::where('nom', $nom)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le moniteur '{$nom}' existe déjà.";
                return null;
            }

            return new Moniteur([
                'nom'          => $nom,
                'fabricant'    => $this->cleanData($row['fabricant'] ?? $row['marque'] ?? ''),
                'modele'       => $this->cleanData($row['modele'] ?? ''),
                'numero_serie' => $numero_serie,
                'detenteur'    => $this->cleanData($row['detenteur'] ?? ''),
                'entite'       => $this->cleanData($row['entite'] ?? $row['service'] ?? ''),
                'lieu'         => $this->cleanData($row['lieu'] ?? $row['emplacement'] ?? ''),
                'type'         => $this->cleanData($row['type'] ?? $row['related_pc'] ?? ''),
                'statut'       => $this->validateStatut($row['statut'] ?? 'En stock'),
                'commentaires' => $this->cleanData($row['commentaires'] ?? $row['observation'] ?? ''),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        } catch (\Exception $e) {
            $this->errors[] = "Ligne {$this->rowCount}: " . $e->getMessage();
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'nom'               => 'required_without:it_identification|string|max:100',
            'it_identification' => 'required_without:nom|string|max:100',
            'numero_serie'      => 'nullable|string|max:100',
            'statut'            => 'nullable|string|max:50',
        ];
    }

    private function validateStatut($statut)
    {
        $validStatuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
        $statut = trim($statut);
        return in_array($statut, $validStatuts) ? $statut : 'En stock';
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
