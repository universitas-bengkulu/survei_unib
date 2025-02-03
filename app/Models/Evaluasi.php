<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'usia',
        'pendidikan',
        'pekerjaan',
        'indikator_id',
        'nama_indikator',
        'instansi',
        'category',
        'skor',
        'created_at',
        'updated_at'
    ];
}
