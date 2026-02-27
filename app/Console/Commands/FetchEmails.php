<?php

namespace App\Console\Commands;

use App\Models\Incident;
use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use App\Models\ticket;
use App\Models\Commentaire;
class FetchEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'command:name';
    protected $signature = 'fetch:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import unseen emails and create tickets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ticket $ticket,Commentaire $commentaire , Incident $incident)
    {


            
        $client = Client::account('default');
        $client->connect();

        
        $folder = $client->getFolder('INBOX');
        $messages = $folder->messages()->unseen()->get();

        //dd($messages);

        foreach ($messages as $message) {
            

        $ticket->sujet = $message->getSubject();
        $ticket->details = $message->getTextBody();
        $ticket->utilisateur_id = 1;
        $ticket->responsable_id = 1;
        $ticket->equipement = 'default';
        $ticket->categorie = 'default';
        $ticket->impact = 'Utilisateur';
        $ticket->state = 2;
        $ticket->status = "en attente";
        $ticket->priorite = 0;
        $ticket->save();

        $findTicket = ticket::latest()->first();
        $commentaire->ticket_id = $findTicket->id;
        $commentaire->utilisateur_id = 1;
        $commentaire->commentaire = "Ticket creer avec succes";
        $commentaire->save();
      
            $message->setFlag('Seen');
        }

        $this->info('Emails imported successfully');
        return 0;
    }
}
