<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemoryOptimization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (memory_get_usage() > 50 * 1024 * 1024) { // 50MB
        abort(500, "Memory usage too high");
    }
    
    $response = $next($request);
    
    // Nettoyage post-requête
    gc_collect_cycles();
    ini_set('memory_limit', '128M');
    
    return $response;
}}
