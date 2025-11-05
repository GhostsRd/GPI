<?php

namespace App\Http\Controllers\utilisateur\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CalendrierReservationCheckout extends Controller
{
    public function index($id,$type){
        return view("Utilisateur.checkout.reservation-checkout-calendrier",compact('id','type')
    );
    }
}
