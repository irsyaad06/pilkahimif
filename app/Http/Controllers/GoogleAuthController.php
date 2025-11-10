<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MahasiswaAktif; // ✅ IMPORT MODEL INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    private function isAdminEmail($email)
    {
        $adminEmails = explode(',', env('ADMIN_EMAILS', ''));
        return in_array($email, $adminEmails);
    }

    private function validateStudentNim($nim)
    {
        // ✅ harus 8 digit angka
        if (!preg_match('/^\d{8}$/', $nim)) {
            return false;
        }

        // ✅ jurusan 101 (Teknik Informatika) - Opsional, jika di MahasiswaAktif sudah pasti 101, ini bisa dihapus, tapi dibiarkan untuk layer keamanan tambahan.
        $jurusan = substr($nim, 0, 3);
        if ($jurusan !== '101') {
            return false;
        }

        return true;
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal mengambil data dari Google. Silakan coba lagi.');
        }

        $email = $googleUser->getEmail();

        // ---------------------------------------------------
        // BYPASS UNTUK ADMIN (Opsional)
        // Jika Anda ingin Admin tetap bisa login meskipun NIM-nya tidak ada di MahasiswaAktif,
        // uncomment blok kode di bawah ini:
        /*
        if ($this->isAdminEmail($email)) {
             $this->loginOrCreateUser($googleUser, $email, 'ADMIN', true);
             return redirect('/admin');
        }
        */
        // ---------------------------------------------------

        // ✅ 1. Validasi domain
        if (!str_ends_with($email, '@mahasiswa.unikom.ac.id')) {
            return redirect('/login')->with('error', 'Login hanya untuk email @mahasiswa.unikom.ac.id');
        }

        // ✅ 2. Validasi format nama.nim
        $local = strstr($email, '@', true);
        $parts = explode('.', $local);

        // Pastikan part terakhir adalah angka (asumsi NIM ada di akhir, misal: nama.depan.nim)
        // Jika format selalu "nama.nim" (hanya 2 bagian), gunakan logika Anda sebelumnya.
        // Tapi untuk jaga-jaga jika ada nama 3 suku kata (budi.santoso.10120001), kita ambil part terakhir sebagai NIM.
        $potentialNim = end($parts);

        if (count($parts) < 2 || !is_numeric($potentialNim)) {
            return redirect('/login')->with('error', 'Format email tidak valid. Gunakan email kampus dengan NIM.');
        }

        $nim = $potentialNim;

        // ✅ 3. Validasi aturan NIM (struktural)
        if (!$this->validateStudentNim($nim)) {
            return redirect('/login')->with('error', 'NIM tidak valid atau bukan dari jurusan yang diizinkan.');
        }

        // ✅ 4. [BARU] Validasi NIM terdaftar di MahasiswaAktif
        // Mengecek apakah NIM ini ada di tabel mahasiswa_aktif
        $mahasiswaTerdaftar = MahasiswaAktif::where('nim', $nim)->exists();

        if (!$mahasiswaTerdaftar) {
            // Jika tidak ditemukan di tabel MahasiswaAktif, tolak login
            return redirect('/login')->with('error', 'Maaf, NIM Anda tidak terdaftar sebagai mahasiswa aktif Teknik Informatika yang berhak memilih.');
        }

        // ✅ 5. Lanjut login / register user
        $user = $this->loginOrCreateUser($googleUser, $email, $nim, $this->isAdminEmail($email));

        Auth::login($user);

        return $user->is_admin
            ? redirect('/admin')
            : redirect('/welcome');
    }

    /**
     * Dipisah ke fungsi private agar lebih rapi
     */
    private function loginOrCreateUser($googleUser, $email, $nim, $isAdmin)
    {
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $email,
                    'nim'       => $nim,
                    'google_id' => $googleUser->getId(),
                    'is_admin'  => $isAdmin,
                ]);
            } else {
                // Update existing email user with google_id
                $user->update([
                    'nim'       => $nim,
                    'google_id' => $googleUser->getId(),
                    'is_admin'  => $isAdmin,
                ]);
            }
        } else {
            // Update existing google user
            $user->update([
                'nim'      => $nim,
                'is_admin' => $isAdmin,
            ]);
        }

        return $user;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}