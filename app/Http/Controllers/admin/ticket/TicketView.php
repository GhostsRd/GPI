<?php

namespace App\Http\Controllers\admin\ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketView extends Controller
{
    public function index()
    {
        return view('admin.ticket.ticket-view');
    }
}
