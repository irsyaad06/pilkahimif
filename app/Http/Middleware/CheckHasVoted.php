<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasVoted
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->has_voted) {
            return redirect('/voting/already');
        }

        return $next($request);
    }
}
