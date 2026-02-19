<?php
use App\Http\Controllers\User\User;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Profiles;
use App\Http\Controllers\ProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::get('/utilisateur', [App\Http\Controllers\Utilisateur\UtilisateurAcceuil::class, 'index'])->name('utilisateur');
Route::middleware(['LoginUser'])->group(function () {
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/utilisateur-service', [App\Http\Controllers\Utilisateur\UtilisateurService::class, 'index'])->name('utilisateurService');
    Route::get('/utilisateur-ticket-{id}', [App\Http\Controllers\Utilisateur\UtilisateurTicket::class, 'index'])->name('utilisateurTicket');
    Route::get('/utilisateur-workflow', [App\Http\Controllers\Utilisateur\Utilisateurworkflow::class, 'index'])->name('utilisateurWorkflow');
    Route::get('/utilisateur-profile', [App\Http\Controllers\Utilisateur\UtilisateurProfile::class, 'index'])->name('utilisateurProfile');
    Route::get('/utilisateur-incident', [App\Http\Controllers\Utilisateur\incident\Incident::class, 'index'])->name('utilisateur.incident');
    Route::get('/utilisateur-dashboard', [App\Http\Controllers\Utilisateur\Dashboard::class, 'index'])->name('utilisateurDashboard');
    Route::get('/utilisateur-checkout', [App\Http\Controllers\Utilisateur\checkout\Checkout::class, 'index'])->name('checkout');
    Route::get('/utilisateur-doc', [App\Http\Controllers\Utilisateur\UtilisateurDoc::class, 'index'])->name('utilisateur-doc');
    Route::get('/utilisateur-checkout-{id}-{type}', [App\Http\Controllers\Utilisateur\checkout\CalendrierReservationCheckout::class, 'index'])->name('checkout.calendrier');
    Route::get('/utilisateur-calendrier', [App\Http\Controllers\Utilisateur\checkout\MesReservationCalendrier::class, 'index'])->name('mes.reservation');
});
Route::post('/utilisateur-logout', [App\Http\Controllers\Utilisateur\UtilisateurLogin::class, 'logout'])->name('utilisateurLogout');
Route::get('/utilisateur-login', [App\Http\Controllers\Utilisateur\UtilisateurLogin::class, 'index'])->name('LoginUser');
Route::get('/utilisateur-inscription', [App\Http\Controllers\Utilisateur\UtilisateurInscription::class, 'index'])->name('utilisateurInscription');
Route::get('/utilisateur-membre', [App\Http\Controllers\Utilisateur\UtilisateurMembre::class, 'index'])->name('utilisateurMembre');
Route::get(uri: '/contact', action: [App\Http\Controllers\Contact::class, 'index'])->name('contact');




Route::get('/moniteur', [App\Http\Controllers\equipement\Moniteur::class, 'index'])->name('moniteur');
Route::get('/admin-doc', [App\Http\Controllers\equipement\Moniteur::class, 'index'])->name('moniteur');

Route::get('/logiciel', [App\Http\Controllers\equipement\logiciel::class, 'index'])->name('logiciel');
Route::get('/ordinateur', [App\Http\Controllers\equipement\ordinateur::class, 'index'])->name('ordinateur');
Route::get('/imprimante', [App\Http\Controllers\equipement\imprimante::class, 'index'])->name('imprimante');
Route::get('/telephone', [App\Http\Controllers\equipement\telephone::class, 'index'])->name('telephone');
Route::get('/peripherique', [App\Http\Controllers\equipement\Peripherique::class, 'index'])->name('peripherique');
Route::get('/equipement', [App\Http\Controllers\equipement\equipement::class, 'index'])->name('equipement');
Route::get('/materiel-reseau', [App\Http\Controllers\equipement\MaterielReseau::class, 'index'])->name('materiel-reseau');
Route::get('/incident', [App\Http\Controllers\equipement\Incident::class, 'index'])->name('incident');
Route::get('/accessoir', [App\Http\Controllers\equipement\accessoir::class, 'index'])->name('accessoir');
Route::get('/mail', [App\Http\Livewire\Login\Utilisateur::class, 'sendEmail']);
Route::post('/login/utilisateur/verification', [App\Http\Controllers\login\utilisateur::class, 'verification']);
Route::post('/userinscription', [App\Http\Controllers\Utilisateur\UtilisateurInscription::class, 'store'])->name('userinscription');
Route::post('/checklogin', [App\Http\Controllers\Utilisateur\UtilisateurLogin::class, 'login'])->name('verifierlogin');
//Route::get('/utilisateur', [App\Http\Controllers\User\User::class, 'utilisateur'])->name('utilisateur');-
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\Acceuil\Acceuil::class, 'index'])->name('home');
    Route::get('/ticket', [App\Http\Controllers\ticket\Ticket::class, 'index'])->name('ticket');
    Route::get('/admin/ticket-view', [App\Http\Controllers\admin\ticket\Ticketview::class, 'index'])->name('adminTicketview');
    Route::get('/admin/ticket-kanban', [App\Http\Controllers\admin\ticket\Kanban::class, 'index'])->name('adminTicketkanban');
    Route::get('/admin/ticket-view-{id}', [App\Http\Controllers\admin\ticket\Ticketview::class, 'ticketview'])->name('checkTicketview');
    Route::get('/admin/checkout',[App\Http\Controllers\admin\checkout\Checkout::class,'index'])->name('checkoutadmin');
    Route::get('/admin/checkout-view-{id}',[App\Http\Controllers\admin\checkout\CheckoutView::class,'index'])->name('checkoutview');
    Route::get('/admin/checkout-reservation',[App\Http\Controllers\admin\checkout\CheckoutReservation::class,'index'])->name('checkout.reservation');
    Route::get('/admin/checkout-reservation-list',[App\Http\Controllers\admin\checkout\CheckoutReservationList::class,'index'])->name('checkout.reservation.list');
    Route::get('/admin/checkout-reservation-view-{id}',[App\Http\Controllers\admin\checkout\reservationView::class,'index'])->name('checkout.reservation.vew');
    
     Route::get('/admin/incident',[App\Http\Controllers\admin\incident\Incident::class,'index'])->name('admin.incident.list');
     Route::get('/admin/incident-view-{id}',[App\Http\Controllers\admin\incident\incidentView::class,'index'])->name('admin.incident.view');
    
    Route::get('/admin/utilisateur',[App\Http\Controllers\admin\profile\UtilisateurListe::class,'index'])->name('listeutilisateur');    
    Route::get('/admin/utilisateur/profile-{id}',[App\Http\Controllers\admin\profile\Profile::class,'index'])->name('userprofile');

    Route::get('/documentation/admin-doc',[App\Http\Controllers\Documentation\AdminDoc::class,'index'])->name('documentation.admin-doc');

    // Routes AJAX pour la gestion des documents via le composant Livewire (utilisé comme contrôleur par le dashboard)
    Route::get('/admin/documents/{id}/edit', [App\Http\Livewire\Documentation\AdminDoc::class, 'edit']);
    Route::post('/admin/documents', [App\Http\Livewire\Documentation\AdminDoc::class, 'store']);
    Route::put('/admin/documents/{id}', [App\Http\Livewire\Documentation\AdminDoc::class, 'update']);
    Route::delete('/admin/documents/{id}', [App\Http\Livewire\Documentation\AdminDoc::class, 'destroy']);
    Route::post('/admin/documents/bulk-delete', [App\Http\Livewire\Documentation\AdminDoc::class, 'bulkDelete']);
    Route::post('/admin/documents/{id}/toggle-publish', [App\Http\Livewire\Documentation\AdminDoc::class, 'togglePublish']);
    Route::get('/admin/documents/{id}/download', [App\Http\Livewire\Documentation\AdminDoc::class, 'download']);
});
// Route temporaire pour tester les téléchargements
Route::get('/documents/{id}/download', function ($id) {
    try {
        $document = \App\Models\Document::where('is_published', true)->find($id);
        
        if (!$document) {
            return redirect()->back()->with('error', 'Document non trouvé');
        }
        
        // Incrémenter le compteur
        $document->increment('downloads');
        
        // Si le document a un fichier
        if ($document->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($document->file_path)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->download(
                $document->file_path,
                $document->file_name ?? 'document_' . $document->id . '.' . ($document->file_extension ?? 'pdf')
            );
        }
        
        // Sinon, rediriger vers la page du document
        return redirect()->route('utilisateur-doc.show', $document->slug ?? $document->id)
            ->with('info', 'Ce document n\'a pas de fichier à télécharger');
            
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erreur lors du téléchargement: ' . $e->getMessage());
    }
})->name('document.download.temp');

// Route AJAX pour incrémenter les téléchargements
Route::post('/documents/{id}/increment-download', function ($id) {
    try {
        $document = \App\Models\Document::find($id);
        if ($document) {
            $document->increment('downloads');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Document non trouvé'], 404);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
});
// ==================== ROUTES DOCUMENTS ====================

// Route pour afficher un document par slug
Route::get('/documents/{slug}', function ($slug) {
    // Logique temporaire - redirige vers la page des documents
    // ou affiche le document si vous avez une vue
    return redirect()->route('utilisateur-doc')->with('slug', $slug);
})->name('documents.show');

// Route pour la liste des documents
Route::get('/documents', function () {
    return redirect()->route('utilisateur-doc');
})->name('documents.index');
// Route temporaire pour éviter l'erreur
