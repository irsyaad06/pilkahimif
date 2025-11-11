<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\DB; // <-- 1. Import DB Facade
use Exception; // <-- 2. Import Exception

class VotingController extends Controller
{
    public function index()
    {
        $paslon = Candidate::all();
        return view('voting.index', compact('paslon'));
    }

    public function submit(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        if (auth()->user()->has_voted) {
            return back()->with('error', 'Anda sudah melakukan voting!');
        }

        try {
            // 3. Mulai Transaksi Database
            // Ini memastikan jika salah satu gagal, keduanya akan dibatalkan.
            DB::transaction(function () use ($request) {
                
                // LANGKAH A: Masukkan surat suara anonim (tanpa user_id)
                Vote::create([
                    'candidate_id' => $request->candidate_id,
                ]);

                // LANGKAH B: Tandai pengguna bahwa dia sudah selesai memilih
                auth()->user()->update(['has_voted' => true]);

            });

        } catch (Exception $e) {
            // Jika terjadi error (misal database mati di tengah proses)
            // Batalkan semua dan kembalikan pesan error
            return back()->with('error', 'Terjadi kesalahan sistem saat menyimpan suara. Silakan coba lagi.');
        }

        // 4. Arahkan ke halaman "sudah memilih".
        // Perbaikan: Menggunakan route 'voting.success' yang menerima ID,
        // (Asumsi route 'voting.success' sudah Anda daftarkan di web.php)
        return redirect()->route('voting.success', [
            'id' => $request->candidate_id
        ]);
    }

    // Method ini sekarang akan dipanggil oleh redirect di atas
    public function success($id)
    {
        $paslon = Candidate::findOrFail($id);
        
        // Menggunakan view 'voting.already' sebagai halaman sukses
        // (Sesuai file voting/already_voted.blade.php yang Anda berikan)
        return view('voting.already', compact('paslon')); 
        // CATATAN: Pastikan Anda punya view 'voting.success_page.blade.php'.
        // Jika Anda ingin menggunakan 'voting/already_voted.blade.php', ganti di atas.
    }
}