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
    //dosen dan tendik
    public function perProdi(){
        $jumlah = EvaluasiRekap::select('pekerjaan','pendidikan',DB::raw('count(pekerjaan) as jumlah'),DB::raw('sum(rata_rata) as skor'))->where('category', 1)->groupBy('pekerjaan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_prodi',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function indikator(){
        $results = $this->getPivotResults(1);

    $questions = DB::table('indikators')->select('id')->where('category', 1)->get();

    $evaluasiList = collect($results)->map(function ($item) {
        return (object) $item;
    });

    return view('operator.laporan.indikator', compact(['evaluasiList', 'questions']));
    }

    public function export(){
        $results = $this->getPivotResults(1);
        $evaluasiList = collect($results)->map(function ($item) {
            return (object) $item;
        });
        $questions = DB::table('indikators')->where('category', 1)->count();

        return Excel::download(
            new EvaluasiExport($evaluasiList, $questions),
            'laporan_evaluasi_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function saran(){
        $sarans = Saran::select('pendidikan','pekerjaan','nama_lengkap','akses','saran','created_at')->orderBy('pendidikan')->where('category', 1)->orderBy('pekerjaan')->orderBy('created_at','desc')->get();
        return view('operator/laporan.saran',[
            'sarans'    => $sarans,
        ]);
    }


    //alumni
    public function indikatorAlumni(){
        $results = $this->getPivotResults(2);

    $questions = DB::table('indikators')->select('id')->where('category', 2)->get();

    $evaluasiList = collect($results)->map(function ($item) {
        return (object) $item;
    });

    return view('operator.laporan.indikator', compact(['evaluasiList', 'questions']));
    }

    public function exportAlumni(){
        $results = $this->getPivotResults(2);
        $evaluasiList = collect($results)->map(function ($item) {
            return (object) $item;
        });
        $questions = DB::table('indikators')->where('category', 2)->count();

        return Excel::download(
            new EvaluasiExport($evaluasiList, $questions),
            'laporan_evaluasi_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function saranAlumni(){
        $sarans = Saran::select('pendidikan','pekerjaan','nama_lengkap','akses','saran','created_at')->orderBy('pendidikan')->where('category', 2)->orderBy('pekerjaan')->orderBy('created_at','desc')->get();
        return view('operator/laporan.saran',[
            'sarans'    => $sarans,
        ]);
    }













    //function export

    public static function generate($category)
    {
        // Get all question IDs from pertanyaan table
        $questions = DB::table('indikators')
            ->select('id')->where('category', $category)
            ->orderBy('id')
            ->get();

        // Start building the pivot query
        $query = DB::table('evaluasis')->select('nama')->where('category', $category);

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
    public static function generateAlternative($category)
    {
        $questions = DB::table('indikators')
            ->select('id')->where('category', $category)
            ->orderBy('id')
            ->get();

        $select = ['nama'];

        foreach ($questions as $question) {
            $select[] = DB::raw("MAX(CASE WHEN indikator_id = {$question->id} THEN skor END) as '{$question->id}'");
        }

        $select[] = DB::raw('SUM(skor) as total');

        return DB::table('evaluasis')
            ->select($select)->where('category', $category)
            ->groupBy('nama')
            ->orderBy('nama');
    }

    // Get results
    public static function getPivotResults($category)
    {
        return self::generate($category)->get();
    }

    // Get SQL
    public static function getPivotSQL($category)
    {
        return self::generate($category)->toSql();
    }
}
