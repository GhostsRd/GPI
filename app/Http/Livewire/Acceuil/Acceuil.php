<?php

namespace App\Http\Livewire\Acceuil;

use App\Models\collecte;
use App\Models\collecteur;
use App\Models\User;
use App\Models\Produit;

use Livewire\Component;

class Acceuil extends Component
{
    public function statistiques(){
        $produits = Produit::all();
        $collectes = Collecte::all();
        $totalagricole = 0;
        $totalpeche = 0;
        $totalforestiare = 0;
        $totalelevage = 0;



        foreach($produits as $produit){
            if($produit->categorie == "Agricole"){
                foreach($collectes as $collect){
                    if($produit->id == $collect->produit_id){
                        $totalagricole++;
                    }
                }}
            if($produit->categorie == "Peche"){
                        foreach($collectes as $collect){
                            if($produit->id == $collect->produit_id){
                                $totalpeche++;
                            }
                        }
                    }
            if($produit->categorie == "Forestier"){
                                foreach($collectes as $collect){
                                    if($produit->id == $collect->produit_id){
                                        $totalforestiare++;
                                    }
                                }
                            }
            if($produit->categorie == "Elevage"){
                    foreach($collectes as $collect){
                            if($produit->id == $collect->produit_id){
                                      $totalelevage++;
                                            }
        }
        }
    }
        return [
            "agricole" => $totalagricole,
            "peche" => $totalpeche,
            "forestier" => $totalforestiare,
            "elevage" => $totalelevage,
        ];

    }
    function randomTextColor()
        {
            // Liste des classes de couleurs Bootstrap
            $colors = [
                'text-primary',     // Bleu
                'text-secondary',  // Gris
                'text-success',    // Vert
                'text-danger',     // Rouge
                'text-warning',    // Jaune
                'text-info',       // Cyan
                'text-light',      // Blanc (peut ne pas être visible sur fond clair)
                'text-dark',       // Noir
                'text-muted',      // Gris clair
                'text-white-50',   // Blanc transparent
            ];

            // Retourner une couleur aléatoire
            return $colors[array_rand($colors)];
        }

    public function render()
    {

        return view('livewire.acceuil.acceuil');
    }
}
