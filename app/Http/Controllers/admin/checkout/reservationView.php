<?php

namespace App\Http\Controllers\admin\checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reservationView extends Controller
{
    public function index($id){
        return view("admin.checkout.reservation-view",
    [
        "id" => $id
    ]);
    }
}
