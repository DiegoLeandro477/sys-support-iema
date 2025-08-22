<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_client_id', auth()->id())->latest()->get();
        return view('client.dashboard', compact('tickets'));
    }

    function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'user_client_id' => auth()->id(),
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Ticket created successfully.');
    }
}
