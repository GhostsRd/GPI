<?php

namespace App\Http\Controllers\ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Ticket extends Controller
{
    //
      public function index(){

        return view("ticket.ticket");
    }
}
