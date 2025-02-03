<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiRekap extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'usia',
        'pendidikan',
        'instansi',
        'category',
        'pekerjaan','total_skor','rata_rata'
    ];
}
