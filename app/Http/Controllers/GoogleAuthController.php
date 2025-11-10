<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        // ✅ jurusan 101 (Teknik Informatika)
        $jurusan = substr($nim, 0, 3);
        if ($jurusan !== '101') {
            return false;
        }

        // ✅ validasi angkatan otomatis
        $angkatan = intval(substr($nim, 3, 2));
        $currentYear = intval(date('y'));     // contoh 25 kalau 2025
        $minAngkatan = $currentYear - 3;      // contoh 22
        $maxAngkatan = $currentYear;          // 25

        if ($angkatan < $minAngkatan || $angkatan > $maxAngkatan) {
            return false;
        }

        return true;
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $email = $googleUser->getEmail();

        // ✅ 1. Validasi domain
        if (!str_ends_with($email, '@mahasiswa.unikom.ac.id')) {
            return redirect('/login')->with('error', 'Login hanya untuk email mahasiswa.unikom.ac.id');
        }

        // ✅ 2. Validasi format nama.nim
        $local = strstr($email, '@', true);
        $parts = explode('.', $local);

        if (count($parts) < 2 || !is_numeric($parts[1])) {
            return redirect('/login')->with('error', 'Format email tidak valid. Gunakan format nama.nim@mahasiswa.unikom.ac.id');
        }

        // ✅ extract NIM
        $nim = $parts[1];

        // ✅ 3. Validasi aturan NIM (jurusan + angkatan)
        if (!$this->validateStudentNim($nim)) {
            return redirect('/login')->with('error', 'NIM tidak valid atau bukan dari jurusan/angkatan yang diizinkan.');
        }

        // ✅ 4. Lanjut login / register
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name'      => $googleUser->getName(),
                    'email'     => $email,
                    'nim'       => $nim,
                    'google_id' => $googleUser->getId(),
                    'is_admin'  => $this->isAdminEmail($email),
                ]);
            } else {
                $user->update([
                    'nim'       => $nim,
                    'google_id' => $googleUser->getId(),
                    'is_admin'  => $this->isAdminEmail($email),
                ]);
            }
        } else {
            $user->update([
                'nim'      => $nim,
                'is_admin' => $this->isAdminEmail($email),
            ]);
        }

        Auth::login($user);

        return $user->is_admin
            ? redirect('/admin')
            : redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
