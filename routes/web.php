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

Route::get('/home', [App\Http\Controllers\Acceuil\Acceuil::class, 'index'])->name('home');
Route::get('/ticket', [App\Http\Controllers\ticket\Ticket::class, 'index'])->name('ticket');
Route::get('/utilisateur', [App\Http\Controllers\Utilisateur\Utilisateur::class, 'index'])->name('utilisateur');
Route::get('/utilisateur-service', [App\Http\Controllers\Utilisateur\UtilisateurService::class, 'index'])->name('utilisateurService');
Route::get('/utilisateur-ticket', [App\Http\Controllers\Utilisateur\UtilisateurTicket::class, 'index'])->name('utilisateurTicket');
Route::get('/utilisateur-workflow', [App\Http\Controllers\Utilisateur\Utilisateurworkflow::class, 'index'])->name('utilisateurWorkflow');
Route::get('/utilisateur-inscription', [App\Http\Controllers\Utilisateur\UtilisateurInscription::class, 'index'])->name('utilisateurInscription');
Route::get('/utilisateur-profile', [App\Http\Controllers\Utilisateur\UtilisateurProfile::class, 'index'])->name('utilisateurProfile');

Route::post('/login/utilisateur/verification', [App\Http\Controllers\login\utilisateur::class, 'verification']);
Route::get('/checkout', [App\Http\Controllers\checkout\Checkout::class, 'index'])->name('checkout');

Route::get('/mail', [App\Http\Livewire\Login\Utilisateur::class, 'sendEmail']);


Route::get('/history/transaction', [App\Http\Controllers\transaction\transaction::class, 'index'])->name('transaction');


Route::get('/utilisateur', [App\Http\Controllers\User\User::class, 'utilisateur'])->name('utilisateur');

