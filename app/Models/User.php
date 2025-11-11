<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nim',
        'kelas',
        'email',
        'google_id',
        'is_admin',
        'has_voted',
    ];

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }

    protected $hidden = [];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        Log::info('canAccessPanel dipanggil untuk user id: ' . $this->id);
        return true;
    }
    public function canAccessFilament(): bool
    {
        Log::info('canAccessFilament dipanggil untuk admin id: ' . $this->id);
        return true;
    }
}
