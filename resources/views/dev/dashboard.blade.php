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
        <div class="area-card column">
            <div class="d-flex justify-content-between mb-2">
                <h6>{{ $ticket->system }}</h6>
                <p>{{ $ticket->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="row">
                <p><strong>{{ $ticket->client->userClient->unidade }}</strong></p>
            </div>
            <div class="d-flex justify-content-between">
                <form method="POST" action="{{ route('dev.ticket.leave',$ticket->id) }}" class="me-2">
                    @csrf
                    <button class="btn btn-outline-primary btn-sm">Deixar</button>
                </form>
                <a href="{{ route('ticket.details', $ticket->id) }}" class=" btn btn-primary btn-sm">Ver detalhes</a>
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
        <div class="area-card column">
            <div class="d-flex justify-content-between mb-2">
                <h6>{{ $ticket->system }}</h6>
                <p>{{ $ticket->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="row">
                <p><strong>{{ $ticket->client->userClient->unidade }}</strong></p>
            </div>
            <div class="d-flex justify-content-between">
                <form method="POST" action="{{ route('dev.ticket.pull',$ticket->id) }}" class="me-2">
                    @csrf
                    <button class="btn btn-sm btn-outline-primary">Puxar</button>
                </form>
                <a href="{{ route('ticket.details', $ticket->id) }}" class="btn btn-primary btn-sm">Ver detalhes</a>
            </div>
        </div>
        @empty
        <div class="area-card text-muted">Nenhum ticket em aberto.</div>
        @endforelse
    </div>
</div>
@endsection
