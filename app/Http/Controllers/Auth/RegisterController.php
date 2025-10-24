<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image; // Optionnel pour redimensionner

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'poste' => ['required', 'string', 'max:255'],
            'lieu_travail' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // 5MB max
            'terms' => ['required', 'accepted'],
        ], [
            'photo.image' => 'Le fichier doit être une image',
            'photo.mimes' => 'L\'image doit être au format JPEG, PNG, JPG, GIF ou WEBP',
            'photo.max' => 'L\'image ne doit pas dépasser 5MB',
            'terms.required' => 'Vous devez accepter les conditions d\'utilisation',
            'terms.accepted' => 'Vous devez accepter les conditions d\'utilisation',
        ]);
    }

    protected function create(array $data)
    {
        $profileImagePath = null;

        // Gérer l'upload de l'image de profil
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $profileImagePath = $this->storeProfileImage($data['photo']);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'poste' => $data['poste'],
            'lieu_travail' => $data['lieu_travail'],
            'password' => Hash::make($data['password']),
            'photo' => $profileImagePath,
        ]);
    }

    /**
     * Stocker l'image de profil avec optimisation
     */
    protected function storeProfileImage(UploadedFile $image)
    {
        // Générer un nom de fichier unique
        $fileName = 'profile_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Stocker l'image originale
        $path = $image->storeAs('profiles', $fileName, 'public');
        
        // Optionnel : Redimensionner l'image pour optimiser l'espace
        $this->optimizeProfileImage($path);
        
        return $path;
    }

    /**
     * Optimiser l'image (optionnel - nécessite intervention/image)
     */
    protected function optimizeProfileImage($imagePath)
    {
        try {
            // Redimensionner l'image à 500x500 pixels maximum
            $image = Image::make(storage_path('app/public/' . $imagePath));
            
            $image->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            // Compresser l'image
            $image->save(storage_path('app/public/' . $imagePath), 80);
            
        } catch (\Exception $e) {
            // En cas d'erreur, on garde l'image originale
            \Log::error('Erreur optimisation image: ' . $e->getMessage());
        }
    }

    protected function registered($request, $user)
    {
        // Actions après inscription réussie
        session()->flash('success', 'Votre compte a été créé avec succès!');
    }
}