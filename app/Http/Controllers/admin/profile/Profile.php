<?php

namespace App\Http\Controllers\admin\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Profile extends Controller
{
    public function index($id){
         $user = Auth::user(); // l'utilisateur connecté
      

        return view("admin.profile.profile",compact("id"));
    }
}
