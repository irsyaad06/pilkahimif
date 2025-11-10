<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CountController extends Controller
{
    public function index()
    {
        // Mengambil semua kandidat beserta jumlah votenya
        // Diurutkan berdasarkan nomor urut
        $candidates = Candidate::withCount('votes')
            ->orderBy('nomor_urut', 'asc')
            ->get();

        // Menghitung total seluruh suara masuk
        $totalVotes = Vote::count();

        // (Opsional) Jika Anda punya model untuk total DPT (Daftar Pemilih Tetap)
        // $totalDpt = \App\Models\User::count(); 
        // Untuk saat ini kita pakai dummy atau bisa Anda sesuaikan nanti
        // $participationRate = $totalDpt > 0 ? ($totalVotes / $totalDpt) * 100 : 0;

        return view('livecount.index', [
            'candidates' => $candidates,
            'totalVotes' => $totalVotes,
            'lastUpdate' => Carbon::now()
        ]);
    }
}
