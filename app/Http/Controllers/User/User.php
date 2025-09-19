<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\collecteur;
use App\Models\qrcode;
use App\Models\Transaction;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;

class User extends Controller
{
    public function index(){
        return view('User.user');
    }
    public function store(Request $request,ModelsUser $users){

      return  response()->json([
            "users" => "ok",
            "status"=> 200,
        ]);
    }
    public function finding($id){
        
        return view('transfer.transfer',[
            'id_receveurs' => qrcode::where('id',$id)->get(),
        ]);

    }
    public function retrait($id){
        
        return view('transfer.retrait',[
            'id_receveurs' => qrcode::where('id',$id)->get(),
        ]);

    }
    

     
         }
