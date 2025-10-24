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
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
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

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $profileImagePath = $this->storeAndResizeProfileImage($data['photo']);
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
     * Stocker et redimensionner l'image avec PHP natif
     */
    protected function storeAndResizeProfileImage(UploadedFile $image)
    {
        // Générer un nom de fichier unique
        $fileName = 'profile_' . time() . '_' . uniqid() . '.jpg';
        
        // Lire l'image originale
        $originalPath = $image->getRealPath();
        $imageInfo = getimagesize($originalPath);
        $mimeType = $imageInfo['mime'];
        
        // Créer l'image selon le type
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($originalPath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($originalPath);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($originalPath);
                break;
            default:
                // Si le format n'est pas supporté, stocker l'original
                return $image->storeAs('profiles', $fileName, 'public');
        }
        
        // Dimensions originales
        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);
        
        // Nouvelles dimensions (carré 500x500)
        $newSize = 500;
        $newWidth = $newSize;
        $newHeight = $newSize;
        
        // Conserver les proportions
        if ($originalWidth > $originalHeight) {
            $newWidth = $newSize;
            $newHeight = intval($originalHeight * $newSize / $originalWidth);
        } else {
            $newHeight = $newSize;
            $newWidth = intval($originalWidth * $newSize / $originalHeight);
        }
        
        // Créer une nouvelle image
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Conserver la transparence pour les PNG
        if ($mimeType == 'image/png') {
            imagealphablending($resizedImage, false);
            imagesavealpha($resizedImage, true);
            $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
            imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);
        }
        
        // Redimensionner
        imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
        
        // Sauvegarder l'image redimensionnée
        $storagePath = storage_path('app/public/profiles/' . $fileName);
        
        // Créer le dossier si nécessaire
        if (!file_exists(dirname($storagePath))) {
            mkdir(dirname($storagePath), 0755, true);
        }
        
        // Sauvegarder en JPEG pour réduire la taille
        imagejpeg($resizedImage, $storagePath, 80);
        
        // Libérer la mémoire
        imagedestroy($sourceImage);
        imagedestroy($resizedImage);
        
        return 'profiles/' . $fileName;
    }

    protected function registered($request, $user)
    {
        session()->flash('success', 'Votre compte a été créé avec succès!');
    }
}