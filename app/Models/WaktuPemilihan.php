<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WaktuPemilihan extends Model
{

    protected $table = 'waktu_pemilihan';
    protected $fillable = [
        'name',
        'waktu_mulai',
        'waktu_berakhir',
        'is_active',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_berakhir' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeCurrent($query)
    {
        $now = Carbon::now();
        return $query->where('waktu_mulai', '<=', $now)
                     ->where('waktu_berakhir', '>=', $now)
                     ->where('is_active', true);
    }

    public function isVotingOpen()
    {
        $now = Carbon::now();
        return $this->is_active &&
               $this->waktu_mulai <= $now &&
               $this->waktu_berakhir >= $now;
    }
}
