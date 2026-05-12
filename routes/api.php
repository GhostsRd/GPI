<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\ticket;
use Illuminate\Support\Facades\Hash;


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
Route::post('/history', 
    function(Request $request,ticket $ticket){
            
        $name = $request->name;

        $ticket->sujet = $request->name;
        $ticket->details = "$request->name";
        $ticket->utilisateur_id = 1;
        $ticket->responsable_id = 1;
        $ticket->equipement = "riuter";
        $ticket->categorie = "trest";
        $ticket->impact = "test";
        $ticket->state = 2;
        $ticket->status = "en attente";
        $ticket->priorite = 1;
        $ticket->save();

        //$req = regisseur::all();
        
      
        
        return response()->json(["statusCode"=> "200"]);

        
    
});

Route::post('/photo', function (Request $request) {

    if (!$request->image) {
        return response()->json([
            "status" => 400,
            "message" => "Image manquante"
        ]);
    }

    $image = $request->image;

    // 🧼 nettoyer base64
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);

    $imageDecoded = base64_decode($image);

    if ($imageDecoded === false) {
        return response()->json([
            "status" => 400,
            "message" => "Base64 invalide"
        ]);
    }

    $fileName = 'screenshots/photo_' . time() . '.png';

    $saved = Storage::disk('public')->put($fileName, $imageDecoded);

    return response()->json([
        "status" => 200,
        "saved" => $saved,
        "file" => $fileName,
        "url" => asset('storage/' . $fileName)
    ]);
});

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

Route::post('/ordinateurs', [App\Http\Livewire\Equipement\Ordinateur::class, 'updateOrdinateurAPI']);

Route::get('/getordinateurs', [App\Http\Livewire\Equipement\Ordinateur::class, 'getOrdinateur']);

Route::post('/imprimantesInventaire', [App\Http\Livewire\Equipement\Imprimante::class, 'UpdateImprimante']);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});
