<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kelas',
        'pendamping_1',
        'pendamping_2',
        'foto_barcode',
        'tiket'
    ];

    public function registrasi()
    {
        return $this->hasOne(Registrasi::class);
    }
}
