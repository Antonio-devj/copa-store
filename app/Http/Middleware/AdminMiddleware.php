<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está logado E se ele é um administrador
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Se não for admin, redireciona para a home com uma mensagem de erro
        return redirect('/')->with('error', 'Acesso negado! Você não tem permissão de vendedor.');
    }
}