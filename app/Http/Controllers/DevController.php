<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class DevController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status', '!=', 'Concluido')->with('client')->latest()->get();
        return view('dev.dashboard', compact('tickets'));
    }
}
