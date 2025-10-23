<?php

namespace App\Imports;

use App\Models\Moniteur;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class MoniteursImport implements ToModel, WithHeadingRow, WithValidation
{
    private $rowCount = 0;
    private $errors = [];

    public function model(array $row)
    {
        // 🔹 Vérifie si la ligne contient un nom (IT Identification)
        if (empty($row['it_identification'])) {
            return null;
        }

        try {
            $this->rowCount++;

            // 🧹 Nettoyage et mappage des données
            $nom          = $this->cleanData($row['it_identification'] ?? '');
            $fabricant    = $this->cleanData($row['marque'] ?? '');
            $modele       = $this->cleanData($row['modele'] ?? '');
            $numero_serie = $this->cleanData($row['s_n'] ?? '');
            $detenteur    = $this->cleanData($row['detenteur'] ?? '');
            $service      = $this->cleanData($row['service'] ?? '');
            $related_pc   = $this->cleanData($row['related_pc'] ?? '');
            $emplacement  = $this->cleanData($row['emplacement'] ?? '');
            $statut       = $this->cleanData($row['statut'] ?? 'En stock');
            $commentaires = $this->cleanData($row['observation'] ?? '');
            $accessoire   = $this->cleanData($row['accessoire_avec'] ?? '');

            // 🔹 Vérifie si le nom existe déjà (unique)
            if (Moniteur::where('nom', $nom)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le nom '{$nom}' existe déjà.";
                return null;
            }

            // 🔹 Vérifie le statut
            $statutsValides = ['En service', 'En stock', 'Hors service', 'En réparation'];
            if (!in_array($statut, $statutsValides)) {
                $statut = 'En stock';
            }

            // 🧱 Crée le moniteur
            return new Moniteur([
                'nom'          => $nom,
                'fabricant'    => $fabricant,
                'modele'       => $modele,
                'numero_serie' => $numero_serie,
                'detenteur'    => $detenteur,
                'entite'       => $service,
                'lieu'         => $emplacement,
                'type'         => $related_pc,
                'statut'       => $statut,
                'commentaires' => trim($commentaires . ' ' . $accessoire),
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
            'it_identification' => 'required|string|max:100',
            'marque'            => 'nullable|string|max:100',
            'modele'            => 'nullable|string|max:100',
            's_n'               => 'nullable|string|max:100',
            'detenteur'         => 'nullable|string|max:100',
            'service'           => 'nullable|string|max:100',
            'related_pc'        => 'nullable|string|max:100',
            'emplacement'       => 'nullable|string|max:150',
            'statut'            => 'nullable|string|max:50',
            'observation'       => 'nullable|string',
            'accessoire_avec'   => 'nullable|string|max:255',
        ];
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function cleanData($value)
    {
        if (is_null($value)) {
            return '';
        }

        $value = trim($value);

        if ($value === 'TRUE') return 'Oui';
        if ($value === 'FALSE') return 'Non';

        return $value;
    }
}
