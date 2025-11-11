<?php

namespace App\Http\Controllers;

use App\Models\WaktuPemilihan;
use Illuminate\Http\Request;

class WaktuPemilihanController extends Controller
{
    public function index()
    {
        $period = WaktuPemilihan::first();
        return response()->json($period);
    }

    public function current()
    {
        $current = WaktuPemilihan::current()->first();
        if ($current) {
            return response()->json([
                'period' => $current,
                'is_open' => $current->isVotingOpen(),
            ]);
        }
        return response()->json(['message' => 'No active voting period'], 404);
    }

    public function show($id)
    {
        $period = WaktuPemilihan::findOrFail($id);
        return response()->json($period);
    }
}
