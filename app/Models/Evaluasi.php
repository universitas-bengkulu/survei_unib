<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function indikator()
    {
        return $this->belongsTo(Indikator::class);
    }
}
