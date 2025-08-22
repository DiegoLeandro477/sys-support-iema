<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {

        // Verifica se o usuáiro está autenticado e se a role dele não corresponde
        // a role esperada, (passada como argumento na role)
        if (!Auth::check() || $request->user()->role->name !== $role) {
            // Se a condição for verdadeira, redireciona ou retorna um erro.
            // O 'abort(403)' retorna um erro 'Acesso Negado'.
            abort(403, 'Você não tem permissão para acessar esta área.');
        }

        // Se o usuário tiver a role correta, continua a requisição
        // e permite o acesso ao próximo middleware ou controlador.

        return $next($request);
    }
}
