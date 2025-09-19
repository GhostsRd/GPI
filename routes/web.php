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

Route::get('/regisseur', [App\Http\Controllers\Regisseur\Regisseur::class, 'index'])->name('admin');
Route::get('/ticket', [App\Http\Controllers\ticket\Ticket::class, 'index'])->name('ticket');


Route::get('/login/utilisateur', [App\Http\Controllers\login\utilisateur::class, 'index'])->name('qr');
Route::post('/login/utilisateur/verification', [App\Http\Controllers\login\utilisateur::class, 'verification']);


Route::get('/mail', [App\Http\Livewire\Login\Utilisateur::class, 'sendEmail']);


Route::get('/history/transaction', [App\Http\Controllers\transaction\transaction::class, 'index'])->name('transaction');

