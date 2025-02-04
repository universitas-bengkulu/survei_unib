<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function indikators()
    {
        return $this->hasMany(Indikator::class);
    }

    public function evaluasis()
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function evaluasiRekaps()
    {
        return $this->hasMany(EvaluasiRekap::class);
    }

    public function sarans()
    {
        return $this->hasMany(Saran::class);
    }

    public function formulirs()
    {
        return $this->hasMany(Formulir::class);
    }
}
