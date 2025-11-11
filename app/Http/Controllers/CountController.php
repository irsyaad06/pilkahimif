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
        // 1. Total DPT (dari MahasiswaAktif)
        $totalVoters = MahasiswaAktif::count();

        // 2. Total yang sudah memilih (dari User)
        $votedCount = User::where('has_voted', true)->count();

        // 3. Total yang belum memilih
        $notVotedCount = $totalVoters - $votedCount;

        // --- Variabel 1 (Sesuai Permintaan Anda) ---
        // Mengambil data 'sudah_memilih' dari tabel 'users'
        // Kuncinya adalah angkatan 2 digit (cth: "22", "21")
        $votedPerAngkatan = User::where('has_voted', true)
            ->select(
                DB::raw('SUBSTRING(nim, 4, 2) as angkatan_short'),
                DB::raw('COUNT(*) as sudah_memilih')
            )
            ->groupBy('angkatan_short') // Group by alias 'angkatan_short'
            ->get()
            ->pluck('sudah_memilih', 'angkatan_short'); // Hasil: ['22' => 1, '21' => 10]

        // --- Variabel 2 (Sesuai Permintaan Anda) ---
        // Mengambil data 'total_pemilih' dari tabel 'mahasiswa_aktif'
        // Ini adalah "master list" kita.
        // Kuncinya adalah angkatan 4 digit (cth: "2022", "2021")
        $votersByBatch = MahasiswaAktif::select(
            'angkatan', // Kolom 'angkatan' (e.g., "2022")
            DB::raw('COUNT(*) as total_pemilih')
        )
            ->groupBy('angkatan') // Query ini valid dan tidak akan error 1055
            ->orderBy('angkatan', 'desc')
            ->get()
            ->map(function ($item) use ($votedPerAngkatan) {

                // $item->angkatan adalah "2022", "2021", dll.
                // $item->total_pemilih adalah totalnya.

                // Buat "kunci pendek" (short key) untuk mencocokkan dengan Variabel 1
                // "2022" -> "22"
                $shortKey = substr($item->angkatan, -2);

                // --- Penggabungan ---
                // Cari $shortKey ("22") di dalam data $votedPerAngkatan
                $item->sudah_memilih = $votedPerAngkatan->get($shortKey) ?? 0;

                // Set data lain untuk view
                $item->angkatan_lengkap = $item->angkatan; // (e.g., "2022")
                $item->belum_memilih = $item->total_pemilih - $item->sudah_memilih;

                return $item;
            });

        // 6. Kirim semua data ke view
        return view('pemilih.index', compact(
            'totalVoters',
            'votedCount',
            'notVotedCount',
            'votersByBatch'
        ));
    }
}
