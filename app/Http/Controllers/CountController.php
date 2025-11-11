<?php

namespace App\Http\Controllers;


use App\Models\Candidate;
use App\Models\Vote;
use App\Models\WaktuPemilihan;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
        $lastVote = Vote::latest()->first();
        $lastUpdate = $lastVote ? $lastVote->created_at : Carbon::now();

        // Mengambil status periode voting
        $votingPeriod = WaktuPemilihan::first();
        $isVotingOpen = $votingPeriod ? $votingPeriod->isVotingOpen() : false;

        return view('livecount.index', [
            'candidates' => $candidates,
            'totalVotes' => $totalVotes,
            'lastUpdate' => $lastUpdate,
            'isVotingOpen' => $isVotingOpen, // Mengirim variabel ke view
            'votingPeriod' => $votingPeriod,
        ]);
    }
}
