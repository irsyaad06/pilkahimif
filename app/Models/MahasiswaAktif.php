<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaAktif extends Model
{

    protected $table = 'mahasiswa_aktif';
    protected $fillable = [
        'nama',
        'nim',
        'status',
        'angkatan',
        
    ];
}
