<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\UserClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // Pega o modelo UserClient associado ao usuário autenticado
        $userClient = auth()->user()->userClient;

        // Se o usuário não tiver um UserClient ou não tiver uma unidade selecionada, redireciona para a página de atualização de dados
        if (!$userClient || !$userClient->unidade) {
            return redirect()->route('client.user.update')->with('warning', 'Por favor, atualize seus dados e selecione uma unidade.');
        }

        // Pega os tickets do cliente a partir da sua relação no modelo UserClient
        $tickets = $userClient->tickets()->latest()->get();
        return view('client.dashboard', compact('tickets'));
    }

    function store(Request $request)
    {
        $request->validate([
            'system' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'system' => $request->system,
            'description' => $request->description,
            'user_client_id' => auth()->user()->userClient->id,
        ]);


        return redirect()->route('client.dashboard')->with('success', 'Ticket created successfully.');
    }

    public function updateData()
    {
        $unidadesJson = file_get_contents(base_path('UNIDADES.json'));
        $unidades = json_decode($unidadesJson, true);

        $userClient = UserClient::where('user_id', auth()->id())->first();
        return view('client.updateData', compact('unidades', 'userClient'));
    }

    function updateDataStore(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        // Garante que o registro UserClient existe ou e
        $userClient = $user->userClient()->firstOrCreate([
            'user_id' => $user->id
        ], [
            'unidade' => '',
            'number_phone' => '',
        ]);

        $userClient->update([
            'number_phone' => $request->number_phone,
            'unidade' => $request->unidade,
            // outros campos se necessário
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('client.dashboard')->with('success', 'User data updated successfully.');
    }
}
