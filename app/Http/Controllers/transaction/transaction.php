<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class transaction extends Controller
{
    public function index(){

        return view("transfer.transaction");
    }



}
