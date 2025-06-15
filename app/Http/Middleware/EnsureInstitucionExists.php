<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Institucion;

class EnsureInstitucionExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $institucion = Institucion::find(1);
        if (!$institucion) {
            // If no institution exists, redirect to the institucion page
            return redirect()->route('institucion.show');
        }
        return $next($request);
    }
}
