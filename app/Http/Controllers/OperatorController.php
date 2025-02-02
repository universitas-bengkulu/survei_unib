<?php

namespace App\Http\Controllers;

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
        $evaluasi = EvaluasiRekap::all()->count();
        $today = EvaluasiRekap::whereDate('created_at', Carbon::today())->get()->count();
        $rata_rata = EvaluasiRekap::select(DB::raw('sum(rata_rata)/"'.$evaluasi.'" as skor'))->first();
        $rata_rata_today = EvaluasiRekap::select(DB::raw('sum(rata_rata)/"'.$today.'" as skor'))->whereDate('created_at', Carbon::today())->first();
        return view('operator.dashboard',[
            'evaluasi' => $evaluasi,
            'today' => $today,
            'rata_rata' => $rata_rata,
            'rata_rata_today' => $rata_rata_today,
        ]);
    }
}
