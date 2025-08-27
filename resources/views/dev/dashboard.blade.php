@extends('dev.layouts.app')

@section('content')
@session('success')
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endsession
<div class="container dashboard-dev">
    <!-- Coluna da esquerda: Tickets sendo atendidos pelo dev -->
    <div class="area-on-tickets">
        <h5 style="margin-top:20px;">Meus Tickets</h5>
        @php
        $myTickets = $tickets->filter(function($ticket) {
        return $ticket->devs->contains(Auth::user());
        });
        @endphp
        @forelse ($myTickets as $ticket)
        <div class="area-card">
            <div class="area-card-left">
                <h6>{{ $ticket->client->name }}</h6>
                <p><strong>{{ $ticket->subject }}</strong></p>
                <p><span class="badge
                @if($ticket->status == 'Aberto') bg-success
                @elseif($ticket->status == 'Em andamento') bg-warning
                @else bg-secondary @endif">
                        {{ $ticket->status }}
                    </span></p>
                <form id="puxe-ticket" action="{{ route('dev.ticket.update-status', $ticket->id) }}" method="POST" class="d-none">
                    @csrf
                    <button>Puxar</button>
                </form>
            </div>
            <div class="area-card-right">
                <p>Data de Criação: {{ $ticket->created_at->format('d/m/Y') }}</p>
                <a href="" class="btn btn-sm btn-outline-primary mt-2">Ver detalhes</a>

            </div>
        </div>
        @empty
        <div class="area-card text-muted">Você não está atendendo nenhum ticket.</div>
        @endforelse
    </div>
    <!-- Coluna da direita: Todos os tickets em aberto -->
    <div class="area-on-tickets">
        <h5 class="subtitle-area-on-ticket">Todos os Tickets em Aberto <span>{{ count($tickets) }}</span></h5>
        <!-- // aqui vai o loop dos tickets que nao contem devs relacionados -->

        @php
        $ticketsSemDev = $tickets->filter(function($ticket) {
        return $ticket->devs->isEmpty();
        });
        @endphp
        @forelse ($ticketsSemDev as $ticket)
        <div class="area-card">
            <div class="area-card-left">
                <h6>{{ $ticket->client->name }}</h6>
                <p><strong>{{ $ticket->subject }}</strong></p>
                <p><span class="badge
                @if($ticket->status == 'Aberto') bg-success
                @elseif($ticket->status == 'Em andamento') bg-warning
                @else bg-secondary @endif">
                        {{ $ticket->status }}
                    </span></p>
                <form id="puxe-ticket" action="{{ route('dev.ticket.update-status', $ticket->id) }}" method="POST" class="d-none">
                    @csrf
                    <button>Puxar</button>
                </form>
            </div>
            <div class="area-card-right">
                <p>Data de Criação: {{ $ticket->created_at->format('d/m/Y') }}</p>
                <a href="" class="btn btn-sm btn-outline-primary mt-2">Ver detalhes</a>

            </div>
        </div>
        @empty
        <div class="area-card text-muted">Nenhum ticket em aberto.</div>
        @endforelse
    </div>
</div>
@endsection
