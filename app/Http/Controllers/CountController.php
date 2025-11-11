<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\MahasiswaAktif; // Import MahasiswaAktif
use App\Models\Vote;
use App\Models\User;
use App\Models\WaktuPemilihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade

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

    public function statistics()
    {

        $totalVoters = MahasiswaAktif::count();
        $votedCount = User::where('has_voted', true)->count();
        $notVotedCount = $totalVoters - $votedCount;
        $votedPerAngkatan = User::where('has_voted', true)
            ->select(
                DB::raw('SUBSTRING(nim, 4, 2) as angkatan_short'),
                DB::raw('COUNT(*) as sudah_memilih')
            )
            ->groupBy('angkatan_short')
            ->get()
            ->pluck('sudah_memilih', 'angkatan_short');
        $votersByBatch = MahasiswaAktif::select(
            'angkatan',
            DB::raw('COUNT(*) as total_pemilih')
        )
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'desc')
            ->get()
            ->map(function ($item) use ($votedPerAngkatan) {


                $shortKey = substr($item->angkatan, -2);

                // --- Penggabungan ---

                $item->sudah_memilih = $votedPerAngkatan->get($shortKey) ?? 0;

                // Set data lain untuk view
                $item->angkatan_lengkap = $item->angkatan; // (e.g., "2022")
                $item->belum_memilih = $item->total_pemilih - $item->sudah_memilih;

                return $item;
            });

        return view('pemilih.index', compact(
            'totalVoters',
            'votedCount',
            'notVotedCount',
            'votersByBatch'
        ));
    }
}
