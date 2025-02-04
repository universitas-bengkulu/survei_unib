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
        'category_id',
        'saran',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
