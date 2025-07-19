<?php

namespace App\Imports;

use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use App\Models\Category;
use App\Models\EvaluasiData;
use App\Models\Formulir;
use App\Models\Indikator;
use App\Models\Saran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class EvaluasisImport implements ToCollection, WithHeadingRow
{
    protected $category_id;

    public function __construct($category_id)
    {
        $this->category_id = $category_id;
    }

    public function collection(Collection $rows)
    {
        $category_id = $this->category_id;

        foreach ($rows as $row) {
            $numericRow = array_values($row->toArray());
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($numericRow[0])->format('Y-m-d');

            $timeValue = trim($numericRow[1]);

            if (is_numeric($timeValue)) {
                $time = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($timeValue)->format('H:i:s');
            } else {
                $dt = \DateTime::createFromFormat('H:i:s', $timeValue)
                    ?: \DateTime::createFromFormat('H:i', $timeValue);

                if ($dt === false) {
                    $time = null;
                } else {
                    $time = $dt->format('H:i:s');
                }
            }
            $datetime = $date . ' ' . $time;
            if (empty($datetime)) {
                $datetime = now();
            }

            $evaluasiRekap = EvaluasiRekap::create([
                'category_id' => $category_id,
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ]);

            $evaluasiRekapId = $evaluasiRekap->id;

            $saran = Saran::create([
                'evaluasi_rekap_id' => $evaluasiRekapId,
                'category_id' => $category_id,
                'saran' => '-',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ]);

            $formulirs = Formulir::where('category_id', $category_id)->get();
            $indikators = Indikator::where('category_id', $category_id)->get();
            $index = 2;

            foreach ($formulirs as $formulir) {
                EvaluasiData::create([
                    'evaluasi_rekap_id' => $evaluasiRekapId,
                    'variable' => $formulir->label,
                    'isi' =>  isset($numericRow[$index]) ? $numericRow[$index] : '-',
                    'created_at' => $datetime,
                    'updated_at' => $datetime,
                ]);

                $index++;
            }

            $loop_indikator = 0;
            foreach ($indikators as $indikator) {
                if (isset($numericRow[$index]) && !is_null($numericRow[$index])) {
                    $indikator = $indikators[$loop_indikator++];
                    Evaluasi::create([
                        'evaluasi_rekap_id' => $evaluasiRekapId,
                        'category_id' => $category_id,
                        'indikator_id' => $indikator->id,
                        'nama_indikator' => $indikator->nama_indikator,
                        'skor' => isset($numericRow[$index]) ? $numericRow[$index] : 0,
                        'created_at' => $datetime,
                        'updated_at' => $datetime,
                    ]);
                }

                $index++;
            }
        }
    }
}
