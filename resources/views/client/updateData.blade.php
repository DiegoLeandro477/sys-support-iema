@extends('layouts.app')

@section('content')

@session('warning')
<div class="alert alert-warning">
    {{ session('warning') }}
</div>
@endsession
<h1>Atualizar informações</h1>
<form action="{{ route('client.user.update') }}" method="post">
    @csrf
    @method('POST')
    <!-- Add your form fields here -->
    <div class="mb-3">
        <label for="name" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">E-mail Institucional</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>
        <div class="col-md-6">
            <label for="number_phone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="number_phone" name="number_phone" placeholder="(99) 99999-9999" value="{{ old('number_phone', $userClient->number_phone ?? '') }}">
        </div>
    </div>
    <div class="mb-3">
        <label for="unidade">Unidade</label>
        <input class="form-control" list="unidades" name="unidade" id="unidade" placeholder="Digite ou selecione..." required value="{{ old('unidade', $userClient->unidade ?? '') }}">
        <datalist id="unidades">
            @foreach($unidades['pleno'] as $unidade)
            <option value="{{ $unidade }}">
                @endforeach
                @foreach($unidades['vocacional'] as $unidade)
            <option value="{{ $unidade }}">
                @endforeach
        </datalist>
    </div>

    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
<script src="https://unpkg.com/imask"></script>
<script>
    var phoneMask = IMask(
        document.getElementById('number_phone'), {
            mask: '(00) 00000-0000'
        }
    );
</script>
@endsection
