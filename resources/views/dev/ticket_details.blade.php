@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Detalhes do ticket (esquerda) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4 class="card-title mb-3"><strong>Sistema:</strong> {{ $ticket->system }}</h4>
                    <p><strong>Descrição:</strong> {{ $ticket->description }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge
                            @if($ticket->status == 'Aberto') bg-success
                            @elseif($ticket->status == 'Em andamento') bg-warning
                            @else bg-secondary @endif">
                            {{ $ticket->status }}
                        </span>
                    </p>
                    <p><strong>Data de Criação:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Cliente:</strong> {{ $ticket->client->name ?? '-' }}</p>
                    <p><strong>Unidade do Cliente:</strong> {{ $ticket->client->userClient->unidade ?? '-' }}</p>
                </div>
            </div>
        </div>
        <!-- Chat (direita) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <!-- Exibe o formulário de mensagem apenas se for dev OU já houver mensagens -->
                    @if(Auth::user()->role->name == 'DEV' || $messages->count() > 0)
                    <h5 class="mb-3">Mensagens</h5>

                    <div class="mb-4 flex-grow-1" style="max-height: 250px; overflow-y: auto;">
                        @forelse($messages as $msg)
                        <div class="mb-2">
                            <span class="fw-bold">{{ $msg->user->name }}:</span>
                            <span>{{ $msg->content }}</span>
                            <span class="text-muted small">({{ $msg->created_at }})</span>
                        </div>
                        @empty
                        <div class="text-muted">Nenhuma mensagem ainda.</div>
                        @endforelse
                    </div>
                    <form method="POST" action="{{ route('ticket.message.send', $ticket->id) }}">
                        @csrf
                        <div class="mb-3">
                            <textarea name="content" class="form-control" rows="2" placeholder="Digite sua mensagem..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                    </form>
                    @else
                    <div class="alert alert-info">Por enquanto nenhuma informação requerida.</div>
                    @if ($ticket->status == 'Em andamento')
                    <p>O desenvolvedor está trabalhando em sua demanda, aguarde finalizar</p>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('dev.dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
</div>
@endsection
