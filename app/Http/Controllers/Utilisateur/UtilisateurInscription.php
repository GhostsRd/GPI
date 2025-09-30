<?php

namespace App\Http\Controllers\utilisateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\utilisateur;

class UtilisateurInscription extends Controller
{

    public $nom;
    public $poste;
    public $departement;
    public $lieu_affectation;
    public $photo;
    public $sexe;
    public $date_naissance;
    public $date_embauche;
    public $adresse;
    public $email;
    public $telephone;
    public $password;
    public $role = 'user';


    public function store(Request $request){
        

        utilisateur::create([
            'matricule' => utilisateur::max('matricule') + 1,
            'nom' => $request->nom,
            'poste' => $request->poste,
            'departement' => $request->departement,
            'lieu_affectation' => $request->lieu_affectation,
            'photo' => $request->photo ? $request->photo->store('photos', 'public') : null,
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'date_embauche' => $request->date_embauche,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => bcrypt($request->password),
            'role' => $this->role,
        ]);

       return view('Utilisateur.utilisateur-inscription');
    }

    public function storeuser(){
       
        $this->validate([
            'nom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'lieu_affectation' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'sexe' => 'required|string|max:10',
            'date_naissance' => 'required|date',
            'date_embauche' => 'required|date',
            'adresse' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'telephone' => 'required|string|max:20|unique:utilisateurs',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $matricule = utilisateur::max('matricule') + 1;

        $photoPath = null;
        if ($this->photo) {
            $photoPath = $this->photo->store('photos', 'public');
        }

     
        utilisateur::create([
            'matricule' => $matricule,
            'nom' => $this->nom,
            'poste' => $this->poste,
            'departement' => $this->departement,
            'lieu_affectation' => $this->lieu_affectation,
            'photo' => $photoPath,
            'sexe' => $this->sexe,
            'date_naissance' => $this->date_naissance,
            'adresse' => $this->adresse,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);
        return redirect()->route('login')->with('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
    }
    public function mount()
    {
        dd($this->nom);
    }
    public function index(){
        return view('Utilisateur.utilisateur-inscription');
    }
}
