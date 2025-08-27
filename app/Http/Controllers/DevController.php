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

    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Em andamento';
        $ticket->save();

        // Relaciona o dev ao ticket (adiciona na tabela pivot)
        $ticket->devs()->syncWithoutDetaching([auth()->id()]);


        return redirect()->route('dev.dashboard')->with('success', 'Status do ticket atualizado com sucesso.');
    }
}
