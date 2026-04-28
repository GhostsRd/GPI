<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Incident;
use App\Models\ticket;
use App\Models\utilisateur;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\chat;
use App\Models\checkoutreserver as matreservations;
use App\Models\Checkout as modelchekout;
use App\Models\ordinateur;
use App\Models\Telephone;
use App\Models\Flotte;
use App\Models\Imprimante;
use App\Models\moniteur;
use App\Models\Peripherique;
use App\Models\SimCard;
use App\Models\liaison_equipement;

class Profile extends Component
{
    public $notifications = [];
    public $lastCount = 0;
    public $message;
    public $profileId;
    
    public $ordinateurs = [];
    public $telephones = [];
    public $flottes = [];
    public $sim_cards = [];
    public $imprimantes = [];
    public $moniteurs = [];
    public $peripheriques = [];
    public $items_a_lier = []; // Tableau pour stocker les équipements à lier
    public $equipements_lies = [];
    public $date_attribution;
    public $date_retour_prevue;
    public $description_liaison;

    public function mount($id)
    {
        $this->notifications = Cache::get('notifications', []);
        $this->lastCount = count($this->notifications);
        $this->profileId = $id;
        $this->date_attribution = now()->format('Y-m-d');
        
        // Initialiser avec une ligne vide
        $this->items_a_lier = [['type' => '', 'id' => '']];
        
        // Charger les équipements disponibles
        $this->loadEquipementsDisponibles();
        $this->chargerEquipementsLies();
    }

    public function loadEquipementsDisponibles()
    {
        // Récupérer les IDs des équipements déjà liés activement
        $liaisonsActives = liaison_equipement::where('statut', 'actif')->get();

        $ordinateurIds = $liaisonsActives->whereNotNull('ordinateur_id')->pluck('ordinateur_id')->toArray();
        $telephoneIds = $liaisonsActives->whereNotNull('telephone_id')->pluck('telephone_id')->toArray();
        $flotteIds = $liaisonsActives->whereNotNull('flotte_id')->pluck('flotte_id')->toArray();
        $simCardIds = $liaisonsActives->whereNotNull('sim_card_id')->pluck('sim_card_id')->toArray();
        $imprimanteIds = $liaisonsActives->whereNotNull('imprimante_id')->pluck('imprimante_id')->toArray();
        $moniteurIds = $liaisonsActives->whereNotNull('moniteur_id')->pluck('moniteur_id')->toArray();
        $peripheriqueIds = $liaisonsActives->whereNotNull('peripheriques_id')->pluck('peripheriques_id')->toArray();

        // Charger uniquement les équipements NON liés
        $this->ordinateurs = ordinateur::whereNotIn('id', $ordinateurIds)->get();
        $this->telephones = Telephone::whereNotIn('id', $telephoneIds)->get();
        $this->flottes = Flotte::whereNotIn('id', $flotteIds)->get();
        $this->sim_cards = SimCard::whereNotIn('id', $simCardIds)->get();
        $this->imprimantes = Imprimante::whereNotIn('id', $imprimanteIds)->get();
        $this->moniteurs = moniteur::whereNotIn('id', $moniteurIds)->get();
        $this->peripheriques = Peripherique::whereNotIn('id', $peripheriqueIds)->get();
    }

    public function chargerEquipementsLies()
    {
        $this->equipements_lies = liaison_equipement::with(['ordinateur', 'telephone', 'flotte', 'sim_card', 'imprimante', 'moniteur', 'peripherique'])
            ->where('utilisateur_id', $this->profileId)
            ->where('statut', 'actif')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function ajouterLigne()
    {
        $this->items_a_lier[] = ['type' => '', 'id' => ''];
    }

    public function supprimerLigne($index)
    {
        unset($this->items_a_lier[$index]);
        $this->items_a_lier = array_values($this->items_a_lier);
        
        if (count($this->items_a_lier) === 0) {
            $this->ajouterLigne();
        }
    }

    public function lierEquipement()
    {
        $this->validate([
            'items_a_lier.*.type' => 'required|in:ordinateur,telephone,flotte,sim_card,imprimante,moniteur,peripherique',
            'items_a_lier.*.id' => 'required',
            'date_attribution' => 'required|date',
        ], [
            'items_a_lier.*.type.required' => 'Le type est obligatoire.',
            'items_a_lier.*.id.required' => 'L\'équipement est obligatoire.',
        ]);

        try {
            $liaisons_count = 0;

            foreach ($this->items_a_lier as $item) {
                $type = $item['type'];
                $id = $item['id'];
                $typeColumn = $type . '_id';

                // Vérifier que l'équipement n'est pas déjà lié
                $dejaLie = liaison_equipement::where('statut', 'actif')
                    ->where($typeColumn, $id)
                    ->exists();

                if ($dejaLie) {
                    $this->dispatchBrowserEvent('notify-error', ['message' => "L'équipement ($type ID: $id) est déjà lié à un autre utilisateur!"]);
                    continue;
                }

                $liaison = new liaison_equipement();
                $liaison->utilisateur_id = $this->profileId;
                $liaison->type = $type;
                $liaison->date_attribution = $this->date_attribution;
                $liaison->date_retour_prevue = $this->date_retour_prevue;
                $liaison->notes = $this->description_liaison;
                $liaison->statut = 'actif';
                $liaison->{$typeColumn} = $id;
                $liaison->save();
                
                $liaisons_count++;
            }

            if ($liaisons_count > 0) {
                // Réinitialiser le formulaire
                $this->items_a_lier = [['type' => '', 'id' => '']];
                $this->description_liaison = '';
                $this->date_retour_prevue = null;
                $this->date_attribution = now()->format('Y-m-d');
                
                // Recharger les listes
                $this->loadEquipementsDisponibles();
                $this->chargerEquipementsLies();

                // Fermer la modale
                $this->dispatchBrowserEvent('close-modal', ['modal' => 'ajouterequipement']);
                $this->dispatchBrowserEvent('notify', ['message' => "$liaisons_count équipement(s) lié(s) avec succès!"]);
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify-error', ['message' => 'Erreur: ' . $e->getMessage()]);
        }
    }

    public function detacherEquipement($id)
    {
        try {
            $liaison = liaison_equipement::find($id);
            if($liaison) {
                $liaison->statut = 'inactif';
                $liaison->date_retour_effectif = now();
                $liaison->save();
                
                $this->loadEquipementsDisponibles();
                $this->chargerEquipementsLies();
                $this->dispatchBrowserEvent('notify', ['message' => 'Équipement détaché avec succès!']);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify-error', ['message' => 'Erreur lors du détachement']);
        }
    }

    public function updatedItemsALier($value, $key)
    {
        // Si le type a changé, on réinitialise l'ID correspondant
        if (str_ends_with($key, '.type')) {
            $index = explode('.', $key)[1];
            $this->items_a_lier[$index]['id'] = '';
        }
    }

    public function EnvoyerMessage()
    {
        $chat = new Chat();
        $utilisateurs = utilisateur::findOrFail($this->profileId);
        $chat->targetmsg_id = $utilisateurs->matricule;
        $chat->utilisateur_id = Auth::user()->id;
        $chat->type = "user";
        $chat->message = $this->message;
        $chat->save();

        $this->message = '';
        $this->emit("refreshComponent");
    }

    public function Visualiser($id)
    {
        return redirect("/admin/checkout-reservation-view-" . $id);
    }

    public function checkNotifications()
    {
        $current = Cache::get('notifications', []);
        $currentCount = count($current);

        if ($currentCount > $this->lastCount) {
            $this->dispatchBrowserEvent('playSound');
        }

        $this->notifications = $current;
        $this->lastCount = $currentCount;
    }

    public function visualiserTicket($id){
        return redirect('/admin/ticket-view-'. $id);
    }

    public function sendNotifications()
    {
        $now = Carbon::now();
        $lastSent = session('last_notification_time', null);

        if (!$lastSent || $now->diffInDays($lastSent) >= 2) {
            $this->notifications[] = [
                'title' => 'Rappel automatique',
                'message' => 'Ceci est votre notification tous les 2 jours.',
                'created_at' => $now
            ];
            session(['last_notification_time' => $now]);
        }
    }

    public function visualiserCheckout($id)
    {
        return redirect('/admin/checkout-view-' . $id);
    }

    public function visualiserIncidentView($id){
        return redirect('/admin/incident-view-'. $id);
    }

    public function render()
    {
        $utilisateurs = utilisateur::findOrFail($this->profileId);
        
        return view('livewire.admin.profile.profile', [
            "utilisateurs" => $utilisateurs,
            "matreservations" => matreservations::where("responsable_id", $this->profileId)->get(),
            "checkouts" => modelchekout::where("utilisateur_id", $this->profileId)
                ->orderBy("created_at", "desc")
                ->paginate(105),
            "tickets" => ticket::where("utilisateur_id", $this->profileId)
                ->orderBy("created_at", "desc")
                ->get(),
            "incidents" => Incident::where("utilisateur_id", $this->profileId)
                ->orderBy("created_at", "desc")
                ->get(),
            "Chats" => Chat::where(function ($query) {
                $userId = Auth::user()->id;
                $query->where('utilisateur_id', $userId)
                    ->orWhere('targetmsg_id', $userId);
            })
                ->where(function ($query) use ($utilisateurs) {
                    $query->where('targetmsg_id', $utilisateurs->matricule)
                        ->orWhere('utilisateur_id', $utilisateurs->matricule);
                })
                ->orderBy('created_at', 'asc')
                ->get(),
            "equipements_lies" => $this->equipements_lies
        ]);
    }
}