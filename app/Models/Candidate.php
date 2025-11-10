<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'nama_paslon',
        'foto',
        'visi',
        'misi'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
