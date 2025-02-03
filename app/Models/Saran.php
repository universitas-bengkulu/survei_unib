<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'usia',
        'pendidikan',
        'pekerjaan',
        'instansi',
        'category',
        'saran',
    ];
}
