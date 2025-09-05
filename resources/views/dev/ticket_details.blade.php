@extends('layouts.app')

@section('content')
<h1>Detalhes do Ticket #{{ $ticket->id }}</h1>
<p><strong>Id do cliente:</strong> {{ $ticket->client->userClient->id }}</p>
<p><strong>unidade:</strong> {{ $ticket->client->userClient->unidade }}</p>
<p><strong>Telefone:</strong> {{ $ticket->client->userClient->number_phone }}</p>
<p><strong>Título:</strong> {{ $ticket->subject }}</p>
<p><strong>Descrição:</strong> {{ $ticket->description }}</p>
<p><strong>Status:</strong> {{ $ticket->status }}</p>
<p><strong>Cliente:</strong> {{ $ticket->client->name }} ({{ $ticket->client->email }})</p>
<p><strong>Desenvolvedores Atribuídos:</strong></p>
<ul>
    @foreach($ticket->devs as $dev)
    <li>{{ $dev->name }} ({{ $dev->email }})</li>
    @endforeach
</ul>
<a href="{{ route('dev.dashboard') }}">Voltar ao Dashboard</a>
@endsection
