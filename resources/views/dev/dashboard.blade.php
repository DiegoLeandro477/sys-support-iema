@extends('layouts.app')

@section('content')
<div class="container dashboard-dev">
    <!-- Coluna da esquerda: Tickets sendo atendidos pelo dev -->
    <div class="area-on-tickets">
        @php
        $myTickets = $tickets->filter(function($ticket) {
        return $ticket->devs->contains(Auth::user());
        });
        @endphp
        <h5 style="margin-top:20px;">Meus Tickets / <span>{{ count($myTickets) }}</span></h5>
        @forelse ($myTickets as $ticket)
        <div class="area-card">
            <div class="area-card-left">
                <h6>{{ $ticket->client->name }}</h6>
                <p><strong>{{ $ticket->client->unidade }}</strong></p>
                <form id="puxe-ticket" action="{{ route('dev.ticket.leave', $ticket->id) }}" method="POST" class="">
                    @csrf
                    <button class="btn">Deixar</button>
                </form>
            </div>
            <div class="area-card-right">
                <p>{{ $ticket->created_at->format('d/m/Y') }}</p>
                <a href="{{ route('dev.ticket.details', $ticket->id) }}" class="btn-details">Ver detalhes</a>
            </div>
        </div>
        @empty
        <div class="area-card text-muted">Você não está atendendo nenhum ticket.</div>
        @endforelse
    </div>
    <!-- Coluna da direita: Todos os tickets em aberto -->
    <div class="area-on-tickets">
        @php
        $ticketsSemDev = $tickets->filter(function($ticket) {
        return $ticket->devs->isEmpty();
        });
        @endphp
        <h5 class="subtitle-area-on-ticket">Todos os Tickets em Aberto / <span>{{ count($ticketsSemDev) }}</span></h5>
        <!-- // aqui vai o loop dos tickets que nao contem devs relacionados -->
        @forelse ($ticketsSemDev as $ticket)
        <div class="area-card">
            <div class="area-card-left">
                <h6>{{ $ticket->client->name }}</h6>
                <p><strong>{{ $ticket->client->unidade }}</strong></p>
                <form id="puxe-ticket" action="{{ route('dev.ticket.pull', $ticket->id) }}" method="POST" class="">
                    @csrf
                    <button class="btn">Puxar</button>
                </form>
            </div>
            <div class="area-card-right">
                <p>{{ $ticket->created_at->format('d/m/Y') }}</p>
                <a href="{{ route('dev.ticket.details', $ticket->id) }}" class="btn-details">Ver detalhes</a>
            </div>
        </div>
        @empty
        <div class="area-card text-muted">Nenhum ticket em aberto.</div>
        @endforelse
    </div>
</div>
@endsection
