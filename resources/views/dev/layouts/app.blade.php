<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Suporte Iema')
    </title>
    <link rel="stylesheet" href="{{ asset('css/dash_dev.css') }}">

</head>

<body>
    <header class="bg-primary">
        <div class="container">
            <nav class="navbar">
                <a class="navbar-brand" href="{{ route('dev.dashboard') }}">Suporte Iema</a>
                <div class="menu">
                    <span class="navbar-text">Bem-vindo, {{ Auth::user()->name ?? 'Dev' }}</span>
                    <a href="{{ route('logout') }}" class="btn-logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Iema. Todos os direitos reservados.
    </footer>
</body>

</html>
