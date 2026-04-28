<?php

namespace App\Imports;

use App\Models\MaterielReseau;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class MaterielReseauxImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    private $rowCount = 0;
    private $errors = [];
    private $requiredHeadings = ['nom'];

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
            if (MaterielReseau::where('nom', $nom)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le matériel '{$nom}' existe déjà.";
                return null;
            }

            if (!empty($numero_serie) && MaterielReseau::where('numero_serie', $numero_serie)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le numéro de série '{$numero_serie}' existe déjà.";
                return null;
            }

            return new MaterielReseau([
                'nom' => $nom,
                'entite' => $this->cleanData($row['entite'] ?? ''),
                'statut' => $this->validateStatut($row['statut'] ?? 'En stock'),
                'fabricant' => $this->cleanData($row['fabricant'] ?? ''),
                'lieu' => $this->cleanData($row['lieu'] ?? ''),
                'reseau_ip' => $this->cleanData($row['reseau_ip'] ?? ''),
                'type' => $this->cleanData($row['type'] ?? ''),
                'modele' => $this->cleanData($row['modele'] ?? ''),
                'numero_serie' => $numero_serie,
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
        $validStatuts = ['En service', 'En stock', 'Hors service', 'En réparation', 'En maintenance'];
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
