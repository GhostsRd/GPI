<?php
use App\Http\Controllers\User\User;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Profiles;


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



Route::middleware(['LoginUser'])->group(function () {
    //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/utilisateur', [App\Http\Controllers\Utilisateur\UtilisateurAcceuil::class, 'index'])->name('utilisateur');
    Route::get('/utilisateur-service', [App\Http\Controllers\Utilisateur\UtilisateurService::class, 'index'])->name('utilisateurService');
    Route::get('/utilisateur-ticket-{id}', [App\Http\Controllers\Utilisateur\UtilisateurTicket::class, 'index'])->name('utilisateurTicket');
    Route::get('/utilisateur-workflow', [App\Http\Controllers\Utilisateur\Utilisateurworkflow::class, 'index'])->name('utilisateurWorkflow');
    Route::get('/utilisateur-profile', [App\Http\Controllers\Utilisateur\UtilisateurProfile::class, 'index'])->name('utilisateurProfile');
    Route::post('utilisateur-logout', [App\Http\Controllers\Utilisateur\UtilisateurLogin::class, 'logout'])->name('utilisateurLogout');
});
Route::get('/utilisateur-login', [App\Http\Controllers\Utilisateur\UtilisateurLogin::class, 'index'])->name('LoginUser');
Route::get('/utilisateur-inscription', [App\Http\Controllers\Utilisateur\UtilisateurInscription::class, 'index'])->name('utilisateurInscription');
Route::get('/utilisateur-membre', [App\Http\Controllers\Utilisateur\UtilisateurMembre::class, 'index'])->name('utilisateurMembre');
Route::get('/utilisateur-dashboard', [App\Http\Controllers\Utilisateur\Dashboard::class, 'index'])->name('utilisateurDashboard');
Route::get('/utilisateur-checkout', [App\Http\Controllers\Utilisateur\checkout\Checkout::class, 'index'])->name('checkout');
Route::get('/moniteur', [App\Http\Controllers\equipement\Moniteur::class, 'index'])->name('moniteur');
Route::get('/logiciel', [App\Http\Controllers\equipement\logiciel::class, 'index'])->name('logiciel');
Route::get('/ordinateur', [App\Http\Controllers\equipement\ordinateur::class, 'index'])->name('ordinateur');
Route::get('/imprimante', [App\Http\Controllers\equipement\imprimante::class, 'index'])->name('imprimante');
Route::get('/telephone', [App\Http\Controllers\equipement\telephone::class, 'index'])->name('telephone');
Route::get('/peripherique', [App\Http\Controllers\equipement\Peripherique::class, 'index'])->name('peripherique');
Route::get('/equipement', [App\Http\Controllers\equipement\equipement::class, 'index'])->name('equipement');
Route::get('/materiel-reseau', [App\Http\Controllers\equipement\MaterielReseau::class, 'index'])->name('materiel-reseau');
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

});
