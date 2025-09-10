@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Nova Solicitação de Suporte</h5>
                    <form method="POST" action="{{ route('client.ticket.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="system" class="form-label">Sistema</label>
                            <input type="text" class="form-control" id="system" name="system" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Solicitação</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <h5>Suas Solicitações</h5>
                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif
                <p>Acompanhe o status das suas solicitações de suporte abaixo.</p>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Solicitações Recentes</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Sistema</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->system }}</td>
                            <td>
                                <span class="badge
                                            @if($ticket->status == 'Aberto') bg-success
                                            @elseif($ticket->status == 'Em andamento') bg-warning
                                            @else bg-secondary @endif">
                                    {{ $ticket->status }}
                                </span>
                            </td>
                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary">Ver detalhes</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Nenhuma solicitação encontrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
