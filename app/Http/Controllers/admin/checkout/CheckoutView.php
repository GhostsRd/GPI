<?php

namespace App\Http\Controllers\admin\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutView extends Controller
{
   

    public function index($id){
        return view("admin.checkout.checkout-view",compact("id"));
    }
}
