<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário está logado
        if (!Auth::check()) {
            // Se o usuário não estiver logado, segue adiante
            return $next($request);
        }

        // Verifica se o usuário tem o papel de admin
        if ($request->user()->hasRole('admin')) {
            return $next($request);
        }

        // Retorna uma resposta de não autorizado
        return response()->json(['error' => 'Não autorizado'], 403);
    }
}