<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\EvaluasiExport;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    public function perProdi(){
        $jumlah = EvaluasiRekap::select('pekerjaan','pendidikan',DB::raw('count(pekerjaan) as jumlah'),DB::raw('sum(rata_rata) as skor'))->where('category_id', 2)->groupBy('pekerjaan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_prodi',[
            'jumlah'    => $jumlah,
        ]);
    }

    public function laporan_per_indikator (Request $request){
        $idd = $request->segment(4);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $category = Category::where('id', $category_id)->first();
        $results = $this->getPivotResults($category_id);

    $questions = DB::table('indikators')->select('id')->where('category_id', $category_id)->get();

    $evaluasiList = collect($results)->map(function ($item) {
        return (object) $item;
    });

    return view('operator.laporan.per_indikator', compact(['evaluasiList', 'questions', 'category']));
    }

    public function export($id, $slug){
        $results = $this->getPivotResults($id);
        $evaluasiList = collect($results)->map(function ($item) {
            return (object) $item;
        });
        $questions = DB::table('indikators')->where('category_id', $id)->get();

        return Excel::download(
            new EvaluasiExport($evaluasiList, $questions),
            'laporan-'.$slug.'-'. date('Y-m-d') . '.xlsx'
        );
    }

    public function saran(Request $request){
        $idd = $request->segment(4);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $category = Category::with('formulirs')->where('id', $category_id)->first();
        $sarans = Saran::with(['evaluasiRekap.evaluasiDatas'])->where('category_id', $category_id)->orderBy('sarans.created_at','desc')->get();


        return view('operator/laporan.saran',[
            'sarans'    => $sarans,
            'category'  => $category,
        ]);
    }

    //function export

    public static function generate($category_id)
    {
        // Get all question IDs from pertanyaan table
        $questions = DB::table('indikators')
            ->select('id')->where('category_id', $category_id)
            ->orderBy('id')
            ->get();

        // Start building the pivot query
        $query = DB::table('evaluasis')
            ->select('evaluasis.evaluasi_rekap_id')
            ->join('indikators', 'indikators.id', '=', 'evaluasis.indikator_id')
            ->where('evaluasis.category_id', $category_id);

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
            ->groupBy('evaluasi_rekap_id')
            ->orderBy('evaluasi_rekap_id');

        return $query;
    }

    // Alternative method using DB::raw() for more complex cases
    public static function generateAlternative($category_id)
    {
        $questions = DB::table('indikators')
            ->select('id')->where('category_id', $category_id)
            ->orderBy('id')
            ->get();

        $select = ['evaluasi_rekap_id'];

        foreach ($questions as $question) {
            $select[] = DB::raw("MAX(CASE WHEN indikator_id = {$question->id} THEN skor END) as '{$question->id}'");
        }

        $select[] = DB::raw('SUM(skor) as total');

        return DB::table('evaluasis')
            ->select($select)->where('category_id', $category_id)
            ->groupBy('evaluasi_rekap_id')
            ->orderBy('evaluasi_rekap_id');
    }

    // Get results
    public static function getPivotResults($category_id)
    {
        return self::generate($category_id)->get();
    }

    // Get SQL
    public static function getPivotSQL($category_id)
    {
        return self::generate($category_id)->toSql();
    }
}
