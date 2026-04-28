<?php

namespace App\Imports;

use App\Models\Logiciel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class LogicielsImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
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
            $editeur = $this->cleanData($row['editeur'] ?? '');

            // Check for uniqueness (nom + editeur combination usually)
            if (Logiciel::where('nom', $nom)->where('editeur', $editeur)->exists()) {
                $this->errors[] = "Ligne {$this->rowCount}: Le logiciel '{$nom}' ({$editeur}) existe déjà.";
                return null;
            }

            return new Logiciel([
                'nom' => $nom,
                'editeur' => $editeur,
                'version_nom' => $this->cleanData($row['version_nom'] ?? ''),
                'version_systeme_exploitation' => $this->cleanData($row['version_systeme_exploitation'] ?? ''),
                'nombre_installations' => intval($row['nombre_installations'] ?? 0),
                'nombre_licences' => intval($row['nombre_licences'] ?? 0),
                'description' => $this->cleanData($row['description'] ?? ''),
                'date_achat' => $this->parseDate($row['date_achat'] ?? null),
                'date_expiration' => $this->parseDate($row['date_expiration'] ?? null),
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
            'editeur' => 'nullable|string|max:100',
            'nombre_licences' => 'nullable|integer',
        ];
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
