<?php

namespace App\Http\Controllers;

use App\Exports\SaranEvaluasiExport;
use App\Imports\EvaluasisImport;
use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Exports\EvaluasiExport;
use App\Models\Category;
use App\Models\Evaluasi;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Str;

class LaporanController extends Controller
{

    public function perProdi()
    {
        $jumlah = EvaluasiRekap::select('pekerjaan', 'pendidikan', DB::raw('count(pekerjaan) as jumlah'), DB::raw('sum(rata_rata) as skor'))->where('category_id', 2)->groupBy('pekerjaan')->orderBy('pendidikan')->get();
        return view('operator/laporan.per_prodi', [
            'jumlah' => $jumlah,
        ]);
    }

    public function laporan_per_indikator(Request $request)
    {
        $filteredYear = $request->get('year');

        $idd = $request->segment(4);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $category = Category::where('id', $category_id)->first();
        $results = $this->getPivotResults($category_id, $filteredYear);

        $questions = DB::table('indikators')->select('id')->where('category_id', $category_id)->get();

        $evaluasiList = collect($results)->map(function ($item) {
            return (object)$item;
        });

        return view('operator.laporan.per_indikator', compact(['evaluasiList', 'questions', 'category', 'filteredYear']));
    }

    public function export(Request $request, $id, $slug)
    {
        $filteredYear = $request->post('year');

        $appendName = $filteredYear ? '- Tahun ' . $filteredYear : '';

        $results = $this->getPivotResults($id, $filteredYear);
        $evaluasiList = collect($results)->map(function ($item) {
            return (object)$item;
        });
        $questions = DB::table('indikators')->where('category_id', $id)->get();

        return Excel::download(
            new EvaluasiExport($evaluasiList, $questions),
            'laporan-' . $slug . '-' . date('Y-m-d') . $appendName . '.xlsx'
        );
    }

    public function saran(Request $request)
    {
        $filteredYear = $request->get('year');

        $idd = $request->segment(4);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $category = Category::with('formulirs')->where('id', $category_id)->first();
        $sarans = Saran::with(['evaluasiRekap.evaluasiDatas'])
            ->when($filteredYear, function ($query, $filteredYear) {
                return $query->whereYear('sarans.created_at', $filteredYear);
            })
            ->where('category_id', $category_id)
            ->orderBy('sarans.created_at', 'desc')
            ->get();

        return view('operator/laporan.saran', [
            'sarans' => $sarans,
            'category' => $category,
            'filteredYear' => $filteredYear,
        ]);
    }

    public function exportSaran(Request $request)
    {
        $filteredYear = $request->get('year');
        $appendName = $filteredYear ? '- Tahun ' . $filteredYear .'-'. time() : time();

        $idd = $request->segment(4);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $category = Category::with('formulirs')->where('id', $category_id)->first();
        $sarans = Saran::with(['evaluasiRekap.evaluasiDatas'])
            ->when($filteredYear, function ($query, $filteredYear) {
                return $query->whereYear('sarans.created_at', $filteredYear);
            })
            ->where('category_id', $category_id)
            ->orderBy('sarans.created_at', 'desc')
            ->get();

        return Excel::download(
            new SaranEvaluasiExport($sarans, $category),
            'Saran Evaluasi-' . $category->nama_category . '-' . $appendName . '.xlsx'
        );
    }

    //function export

    public static function generate($category_id, $filterYear = null)
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
            ->when($filterYear, function ($query, $filterYear) {
                return $query->whereYear('evaluasis.created_at', $filterYear);
            })
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
    public static function getPivotResults($category_id, $filterYear = null)
    {
        return self::generate($category_id, $filterYear)->get();
    }

    // Get SQL
    public static function getPivotSQL($category_id)
    {
        return self::generate($category_id)->toSql();
    }

    public function import(Request $request, $category_id, $slug)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new EvaluasisImport, $request->file('file'), $category_id);

        return back()->with('success', 'Data evaluasi berhasil diimpor.');
    }

    public function generateTemplate($category_id, $slug)
    {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Get all active indikators
        $indikators = Indikator::where('ditampilkan', true)
            ->where('category_id', $category_id)
            ->orderBy('category_id')
            ->get();

        // Set up column widths and styles
        $columnWidth = 30;
        $headerHeight = 60;

        // Start from column A
        $currentColumn = 'A';

        // Add headers based on indikator names
        foreach ($indikators as $indikator) {
            // Set the header value
            $sheet->setCellValue($currentColumn . '1', $indikator->nama_indikator);

            // Set column width
            $sheet->getColumnDimension($currentColumn)->setWidth($columnWidth);

            // Style the header cell
            $sheet->getStyle($currentColumn . '1')->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true
                ],
                'font' => [
                    'bold' => true
                ]
            ]);

            // Move to next column
            $currentColumn++;
        }

        // Set row height for header
        $sheet->getRowDimension(1)->setRowHeight($headerHeight);

        // Add example row
        $currentColumn = 'A';
        foreach ($indikators as $indikator) {
            $sheet->setCellValue($currentColumn . '2', '4');
            $sheet->getStyle($currentColumn . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $currentColumn++;
        }

        // Create response
        $writer = new Xlsx($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="template-'.$slug.'.xlsx"');
        header('Cache-Control: max-age=0');

        // Save to PHP output stream
        $writer->save('php://output');
        exit;
    }

}
