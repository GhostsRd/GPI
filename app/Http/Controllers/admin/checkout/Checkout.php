<?php

namespace App\Http\Controllers\admin\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index(){
        return view("admin.checkout.checkout");
    }
}
