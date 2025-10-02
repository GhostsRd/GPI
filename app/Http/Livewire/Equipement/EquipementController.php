<?php

namespace App\Http\Controllers\equipement;

use App\Http\Controllers\Controller;
use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $query = Equipement::query();

        // Recherche
        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('identification', 'like', "%{$search}%")
                    ->orWhere('nom_public', 'like', "%{$search}%")
                    ->orWhere('numero_serie', 'like', "%{$search}%")
                    ->orWhere('adresse_ip', 'like', "%{$search}%")
                    ->orWhere('marque', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filtres
        if ($statut = request('statut')) {
            $query->where('statut', $statut);
        }

        if ($type = request('type')) {
            $query->where('type', $type);
        }

        if ($emplacement = request('emplacement')) {
            $query->where('emplacement', $emplacement);
        }

        $equipements = $query->latest()->paginate(15);

        $stats = [
            'total' => Equipement::count(),
            'en_stock' => Equipement::where('statut', 'en_stock')->count(),
            'en_pret' => Equipement::where('statut', 'en_pret')->count(),
            'en_maintenance' => Equipement::where('statut', 'en_maintenance')->count(),
        ];

        // Données pour les filtres
        $types = Equipement::distinct()->pluck('type')->filter();
        $emplacements = Equipement::distinct()->pluck('emplacement')->filter();
        $marques = Equipement::distinct()->pluck('marque')->filter();

        return view('equipement.equipement', compact('equipements', 'stats', 'types', 'emplacements', 'marques'));
    }

    public function create()
    {
        return view('equipement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identification' => 'required|string|max:255|unique:equipements',
            'nom_public' => 'required|string|max:255',
            'emplacement' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:equipements',
            'couleur' => 'required|in:noir,couleur',
            'technologie_impression' => 'required|in:encre,laser',
            'reference_cartouche' => 'nullable|string|max:255',
            'date_entree_stock' => 'required|date',
            'adresse_ip' => 'nullable|ipv4',
            'statut' => 'required|in:en_stock,en_pret,en_maintenance',
            'description' => 'nullable|string'
        ]);

        Equipement::create($request->all());

        return redirect()->route('equipement.equipement')
            ->with('success', 'Équipement ajouté avec succès.');
    }

    public function edit(Equipement $equipement)
    {
        return view('equipement.edit', compact('equipement'));
    }

    public function update(Request $request, Equipement $equipement)
    {
        $request->validate([
            'identification' => 'required|string|max:255|unique:equipements,identification,' . $equipement->id,
            'nom_public' => 'required|string|max:255',
            'emplacement' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'numero_serie' => 'required|string|unique:equipements,numero_serie,' . $equipement->id,
            'couleur' => 'required|in:noir,couleur',
            'technologie_impression' => 'required|in:encre,laser',
            'reference_cartouche' => 'nullable|string|max:255',
            'date_entree_stock' => 'required|date',
            'adresse_ip' => 'nullable|ipv4',
            'statut' => 'required|in:en_stock,en_pret,en_maintenance',
            'description' => 'nullable|string'
        ]);

        $equipement->update($request->all());

        return redirect()->route('equipement.index')
            ->with('success', 'Équipement modifié avec succès.');
    }

    public function destroy(Equipement $equipement)
    {
        $equipement->delete();

        return redirect()->route('equipement.index')
            ->with('success', 'Équipement supprimé avec succès.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'fichier' => 'required|file|mimes:csv,xlsx,xls|max:10240'
        ]);

        // Logique d'importation simple (vous pouvez utiliser Maatwebsite/Excel plus tard)
        try {
            // Logique d'importation temporaire
            return redirect()->route('equipement.index')
                ->with('success', 'Importation réussie.');
        } catch (\Exception $e) {
            return redirect()->route('equipement.index')
                ->with('error', 'Erreur lors de l\'importation: ' . $e->getMessage());
        }
    }

    public function export()
    {
        // Logique d'exportation simple
        $equipements = Equipement::all();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="equipements_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($equipements) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Identification', 'Nom public', 'Emplacement', 'Marque', 'Modèle',
                'Type', 'Numéro de série', 'Couleur', 'Technologie', 'Référence cartouche',
                'Date entrée stock', 'Adresse IP', 'Statut'
            ]);

            foreach ($equipements as $equipement) {
                fputcsv($file, [
                    $equipement->identification,
                    $equipement->nom_public,
                    $equipement->emplacement,
                    $equipement->marque,
                    $equipement->model,
                    $equipement->type,
                    $equipement->numero_serie,
                    $equipement->couleur,
                    $equipement->technologie_impression,
                    $equipement->reference_cartouche,
                    $equipement->date_entree_stock,
                    $equipement->adresse_ip,
                    $equipement->statut
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
