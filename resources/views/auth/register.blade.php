<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte Iema</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="card shadow" style="max-width: 400px; width: 100%;">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="mt-2 mb-0">Criar Usuário</h4>
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                @endif
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome e Sobrenome</label>
                        <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-2">Cadastrar</button>
                    <a href="{{ route('login') }}" class="btn w-100">Cancelar</a>
                </form>
            </div>
        </div>
        <footer class="mt-4 text-muted small text-center">
            &copy; {{ date('Y') }} Iema. Todos os direitos reservados.
        </footer>
    </div>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
