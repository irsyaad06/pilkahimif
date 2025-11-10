<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'calon_ketua',
        'calon_wakil_ketua',
        'nomor_urut',
        'foto',
        'visi',
        'misi'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
