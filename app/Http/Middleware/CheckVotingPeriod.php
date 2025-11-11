<?php

namespace App\Http\Middleware;

use App\Models\WaktuPemilihan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVotingPeriod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $votingPeriod = WaktuPemilihan::first();
        $isVotingOpen = $votingPeriod ? $votingPeriod->isVotingOpen() : false;

        if (!$isVotingOpen) {
            return redirect('/welcome')->with('warning', 'Periode voting belum dibuka atau sudah berakhir.');
        }

        return $next($request);
    }
}