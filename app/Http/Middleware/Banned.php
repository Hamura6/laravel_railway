<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Banned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si NO está autenticado → dejar pasar (normalmente va al login)
        if (!Auth::check()) {
            return $next($request); // ¡Importante! No redirigir aquí
        }

        $user = Auth::user();

        // Cambia 'status' y 'ENABLED' según tu columna y valor real
        if ($user->status !== 'ENABLED') {
            Auth::logout();

            // Mensaje más profesional y genérico
            $message ='Tu cuenta se encuentra temporalmente desactivada';

            return redirect()->route('login')->with('error', $message);
        }

        // Todo bien → continuar
        return $next($request);
    }
}
