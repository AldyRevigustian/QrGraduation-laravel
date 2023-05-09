<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        "siswa_id",
        "name",
        "status"
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
