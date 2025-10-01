<?php

namespace App\Http\Controllers\admin\ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketView extends Controller
{
    public function ticketview($id)
    {
        return view('admin.ticket.ticket-view', compact('id'));
    }
    public function index()
    {
        return view('admin.ticket.ticket-view');
    }
}
