<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureThatUserIsAdmin
{

    public function handle(Request $request, Closure $next): Response | RedirectResponse
    {
        if ($request->user()->role !== "admin") {
            return redirect('/');
        }

        return $next($request);
    }
}
