<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UtilisateurInscription extends Controller
{
    public function index()
    {
        return view('Utilisateur.utilisateur-inscription');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'lieu_affectation' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sexe' => 'required|string|in:Homme,Femme',
            'date_naissance' => 'required|date',
            'date_embauche' => 'required|date',
            'adresse' => 'required|string|max:500',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'telephone' => 'required|string|max:20|unique:utilisateurs',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ]);

        try {
            // Générer le matricule
            $matricule = Utilisateur::max('matricule') + 1;

            // Gestion de l'upload de la photo
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
            }

            // Création de l'utilisateur
            Utilisateur::create([
                'matricule' => $matricule,
                'nom' => $validatedData['nom'],
                'poste' => $validatedData['poste'],
                'departement' => $validatedData['departement'],
                'lieu_affectation' => $validatedData['lieu_affectation'],
                'photo' => $photoPath,
                'sexe' => $validatedData['sexe'],
                'date_naissance' => $validatedData['date_naissance'],
                'date_embauche' => $validatedData['date_embauche'],
                'adresse' => $validatedData['adresse'],
                'email' => $validatedData['email'],
                'telephone' => $validatedData['telephone'],
                'password' => Hash::make($validatedData['password']),
                'role' => 'user',
            ]);

            return redirect()->route('LoginUser')
    ->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'inscription: ' . $e->getMessage())
                ->withInput();
        }
    }
}