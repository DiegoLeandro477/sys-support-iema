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

    public function pullTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'Em andamento';
        $ticket->save();

        // Relaciona o dev ao ticket (adiciona na tabela pivot)
        $ticket->devs()->syncWithoutDetaching([auth()->id()]);


        return redirect()->route('dev.dashboard')->with('success', 'Status do ticket atualizado com sucesso.');
    }

    public function leaveTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        // Remove o dev do ticket (remove da tabela pivot)
        $ticket->devs()->detach([auth()->id()]);

        // Se não houver mais devs associados, atualiza o status para 'Aberto'
        if ($ticket->devs()->count() === 0) {
            $ticket->status = 'Aberto';
            $ticket->save();
        }

        return redirect()->route('dev.dashboard')->with('success', 'Você saiu do ticket com sucesso.');
    }

    public function viewTicketDetails($id)
    {
        $ticket = Ticket::with(['client', 'devs'])->findOrFail($id);
        return view('dev.ticket_details', compact('ticket'));
    }
}
