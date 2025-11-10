<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'nim' => '0000000001',
                'kelas' => 'Admin',
                'google_id' => 'manual-admin', // boleh bebas asal unik
                'is_admin' => true,
            ]
        );
    }
}
