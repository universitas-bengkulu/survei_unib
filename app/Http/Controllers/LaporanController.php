<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\EvaluasiExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function perProdi(){
        $jumlah = EvaluasiRekap::select('pekerjaan','pendidikan',DB::raw('count(pekerjaan) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('pekerjaan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_prodi',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function perFakultas(){
        $jumlah = EvaluasiRekap::select('pendidikan',DB::raw('count(pendidikan) as jumlah'),DB::raw('sum(rata_rata) as skor'))->groupBy('pendidikan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_fakultas',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function keseluruhan(){
        $jumlah = EvaluasiRekap::select('pendidikan','pekerjaan','nama_lengkap','akses','total_skor','rata_rata','created_at')->orderBy('pendidikan')->orderBy('pekerjaan')->get();
        return view('operator/laporan.keseluruhan',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function indikator(){
        $results = $this->getPivotResults();
     
    $questions = DB::table('indikators')->count(); 
    $evaluasiList = collect($results)->map(function ($item) {
        return (object) $item;
    });

    return view('operator.laporan.indikator', compact(['evaluasiList', 'questions']));
    }

    public function export(){
        $results = $this->getPivotResults();
        $evaluasiList = collect($results)->map(function ($item) {
            return (object) $item;
        });
        $questions = DB::table('indikators')->count();

        return Excel::download(
            new EvaluasiExport($evaluasiList, $questions), 
            'laporan_evaluasi_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function saran(){
        $sarans = Saran::select('pendidikan','pekerjaan','nama_lengkap','akses','saran','created_at')->orderBy('pendidikan')->orderBy('pekerjaan')->orderBy('created_at','desc')->get();
        return view('operator/laporan.saran',[
            'sarans'    => $sarans,
        ]);
    }


    public static function generate()
    {
        // Get all question IDs from pertanyaan table
        $questions = DB::table('indikators')
            ->select('id')
            ->orderBy('id')
            ->get();

        // Start building the pivot query
        $query = DB::table('evaluasis')->select('nama');

        // Dynamically add CASE statements for each question
        foreach ($questions as $question) {
            // Fixed: Remove parameter binding and use direct value interpolation
            // since we're dealing with fixed column names
            $query->selectRaw(
                "MAX(CASE WHEN indikator_id = {$question->id} THEN skor END) as '{$question->id}'"
            );
        }

        // Add total column
        $query->selectRaw('SUM(skor) as total')
            ->groupBy('nama')
            ->orderBy('nama');

        return $query;
    }

    // Alternative method using DB::raw() for more complex cases
    public static function generateAlternative()
    {
        $questions = DB::table('indikators')
            ->select('id')
            ->orderBy('id')
            ->get();

        $select = ['nama'];
        
        foreach ($questions as $question) {
            $select[] = DB::raw("MAX(CASE WHEN indikator_id = {$question->id} THEN skor END) as '{$question->id}'");
        }
        
        $select[] = DB::raw('SUM(skor) as total');

        return DB::table('evaluasis')
            ->select($select)
            ->groupBy('nama')
            ->orderBy('nama');
    }

    // Get results
    public static function getPivotResults()
    {
        return self::generate()->get();
    }

    // Get SQL
    public static function getPivotSQL()
    {
        return self::generate()->toSql();
    }
}
