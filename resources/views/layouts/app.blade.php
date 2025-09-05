<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Suporte Iema')
    </title>
    <link rel="stylesheet" href="{{ asset('css/dash_dev.css') }}?v={{ time() }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar container">
            <a class="navbar-brand" href="/">SUPORTE IEMA</a>
            <div class="menu">
                <?php
                $nomeCompleto = Auth::user()->name;
                $partes = explode(' ', trim($nomeCompleto));
                $primeiro = $partes[0];
                $ultimo = count($partes) > 1 ? $partes[count($partes) - 1] : '';
                $boasVindas = $primeiro . ($ultimo ? ' ' . $ultimo : '');
                ?>
                <span class="navbar-text">Bem-vindo, {{ $boasVindas }}</span>
                <a href="{{ route('logout') }}" class="btn-logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Iema. Todos os direitos reservados.
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
