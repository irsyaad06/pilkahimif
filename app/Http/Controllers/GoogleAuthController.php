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
        $adminEmails = explode(',', env('ADMIN_EMAILS', 'irsyaad.10122074@mahasiswa.unikom.ac.id'));
        return in_array($email, $adminEmails);
    }

    private function extractNimFromEmail($email)
    {
        $localPart = explode('@', $email)[0];
        return explode('.', $localPart)[0];
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $nim = $this->extractNimFromEmail($googleUser->getEmail());

        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'nim' => $nim,
                    'google_id' => $googleUser->getId(),
                    'is_admin' => $this->isAdminEmail($googleUser->getEmail()),
                ]);
            } else {
                $user->update([
                    'nim' => $nim,
                    'google_id' => $googleUser->getId(),
                    'is_admin' => $this->isAdminEmail($googleUser->getEmail()),
                ]);
            }
        } else {
            $user->update([
                'nim' => $nim,
                'is_admin' => $this->isAdminEmail($googleUser->getEmail()),
            ]);
        }

        Auth::guard('web')->login($user);

        return $user->is_admin
            ? redirect('/admin')
            : redirect('/voting');
    }
}
