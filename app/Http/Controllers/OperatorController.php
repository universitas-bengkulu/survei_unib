<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function dashboard(){
        $jumlah_survei = Category::count();

    $categories = Category::all();
    $evaluasi_per_category = [];

    foreach ($categories as $category) {
        $evaluasi_per_category[$category->id] = [
            'jumlah_evaluasi' => EvaluasiRekap::where('category_id', $category->id)->count(),
            'jumlah_evaluasi_today' => EvaluasiRekap::where('category_id', $category->id)->whereDate('created_at', Carbon::today())->count(),
            'average_skor' => Evaluasi::where('category_id', $category->id)->avg('skor'),
            'average_skor_today' => Evaluasi::where('category_id', $category->id)->whereDate('created_at', Carbon::today())->avg('skor'),
        ];
    }

    return view('operator.dashboard', [
        'jumlah_survei' => $jumlah_survei,
        'evaluasi_per_category' => $evaluasi_per_category,
        'categories' => $categories,
    ]);
    }
}
