<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request, $ticketId)
    {
        $request->validate([
            'content' => 'required|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $data = [
            'ticket_id' => $ticketId,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'sent_at' => now(),
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        \App\Models\Message::create($data);

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
