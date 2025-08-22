w
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
                    <h4 class="mt-2 mb-0">Suporte Iema</h4>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
                <div class="mt-3 text-center d-flex flex-column gap-2">
                    <a href="#" class="text-decoration-none">Esqueceu a senha?</a>
                    <a href="{{ route('register') }}" class="text-decoration-none">Cadastrar novo usuário</a>
                </div>
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
