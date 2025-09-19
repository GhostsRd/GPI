<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Profiles;
use App\Http\Livewire\User\User;


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



Route::get('/paramétre/user', [App\Http\Controllers\User\User::class, 'index'])->name('user');

Route::get('/find/{id}', [App\Http\Controllers\Qrcode\Qrcode::class, 'find'])->name('find');
Route::get('/affiche_QR/{id}', [App\Http\Controllers\qrcode\Affiche_qr::class, 'find'])->name('qr');


Route::get('/gerer/actus', [App\Http\Controllers\actus\Actus::class, 'index'])->name('actus');

Route::get('/gerer/actus', [App\Http\Controllers\actus\Actus::class, 'index'])->name('actus');
Route::get('/admin', [App\Http\Controllers\gerer\auth::class, 'index'])->name('admin');
Route::get('/regisseur', [App\Http\Controllers\Regisseur\Regisseur::class, 'index'])->name('admin');


Route::post('/tranferer', [App\Http\Controllers\User\User::class, 'transferer'])->name('tran');

Route::get('/finding/{id}', [App\Http\Controllers\User\User::class, 'finding'])->name('admin');

Route::get('/produit', [App\Http\Controllers\gerer\produit::class, 'index'])->name('produit');


Route::get('/retrait/{id}', [App\Http\Controllers\User\User::class, 'retrait'])->name('admin');

Route::post('/retrait/argent', [App\Http\Controllers\User\User::class, 'argent'])->name('argent');

Route::post('/prametre/update', [App\Http\Livewire\User\User::class, 'update'])->name('update');


Route::get('/login/utilisateur', [App\Http\Controllers\login\utilisateur::class, 'index'])->name('qr');
Route::post('/login/utilisateur/verification', [App\Http\Controllers\login\utilisateur::class, 'verification']);


Route::get('/mail', [App\Http\Livewire\Login\Utilisateur::class, 'sendEmail']);


Route::get('/history/transaction', [App\Http\Controllers\transaction\transaction::class, 'index'])->name('transaction');

