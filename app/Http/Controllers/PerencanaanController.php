<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiRekap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerencanaanController extends Controller
{
    public function dashboard(){
        $jumlah = EvaluasiRekap::select('fakultas',DB::raw('count(fakultas) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('fakultas')->orderBy('fakultas')->get();
        $evaluasi = EvaluasiRekap::all()->count();
        $rata_rata = EvaluasiRekap::select(DB::raw('sum(rata_rata)/"'.$evaluasi.'" as skor'))->first();
        return view('perencanaan.dashboard',[
            'evaluasi' => $evaluasi,
            'rata_rata' => $rata_rata,
            'jumlah' => $jumlah,
        ]);
    }
}
