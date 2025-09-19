<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/users', [App\Http\Controllers\User\User::class, 'fetchdata']);
Route::post('/user/store', [App\Http\Controllers\User\User::class, 'store']);

Route::post('/user/image', [App\Http\Livewire\User\User::class, 'image']);


Route::post('/user/verification', [App\Http\Livewire\User\User::class, 'verification']);
// publication api

Route::post('/publication/store', [App\Http\Livewire\Actus\Actus::class, 'store']);

Route::get('/produits', [App\Http\Livewire\Login\Utilisateur::class, 'getproduit']);

Route::post('/login', [App\Http\Livewire\Login\Utilisateur::class, 'login']);

Route::post('/change-password', [App\Http\Livewire\Login\Utilisateur::class, 'changeCode']);

Route::post('/collectes', [App\Http\Livewire\Login\Utilisateur::class, 'collectes']);

Route::get('/Regisseur/collectes', [App\Http\Livewire\Login\Utilisateur::class, 'getCollecte']);

Route::get('/valeur', [App\Http\Livewire\Acceuil\Acceuil::class, 'statistiques']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
