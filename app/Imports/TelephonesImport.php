<?php

namespace App\Imports;

use App\Models\Telephone;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class TelephonesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
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
            if (Telephone::where('nom', $nom)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: L'équipement '{$nom}' existe déjà.";
                return null;
            }

            if (!empty($numero_serie) && Telephone::where('numero_serie', $numero_serie)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le numéro de série '{$numero_serie}' existe déjà.";
                return null;
            }

            return new Telephone([
                'nom' => $nom,
                'entite' => $this->cleanData($row['entite'] ?? ''),
                'usager' => $this->cleanData($row['usager'] ?? ''),
                'lieu' => $this->cleanData($row['lieu'] ?? 'Non spécifié'),
                'services' => $this->cleanData($row['services'] ?? ''),
                'type' => $this->validateType($row['type'] ?? 'Téléphone'),
                'marque' => $this->cleanData($row['marque'] ?? ''),
                'modele' => $this->cleanData($row['modele'] ?? ''),
                'numero_serie' => $numero_serie,
                'statut' => $this->validateStatut($row['statut'] ?? 'En stock'),
                'emplacement_actuel' => $this->cleanData($row['emplacement_actuel'] ?? 'Non spécifié'),
                'imei' => $this->cleanData($row['imei'] ?? ''),
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
            'numero_serie' => 'required|string|max:100',
            'statut' => 'nullable|string|max:50',
            'type' => 'nullable|string|in:Téléphone,Tablette',
        ];
    }

    private function validateStatut($statut)
    {
        $validStatuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
        $statut = trim($statut);
        return in_array($statut, $validStatuts) ? $statut : 'En stock';
    }

    private function validateType($type)
    {
        $validTypes = ['Téléphone', 'Tablette'];
        $type = trim($type);
        return in_array($type, $validTypes) ? $type : 'Téléphone';
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
