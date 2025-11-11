<?php

namespace App\Http\Controllers\admin\incident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class incidentView extends Controller
{
    public function index($id){
        return view("admin.incident.incident-view",compact("id"));
    }
}
