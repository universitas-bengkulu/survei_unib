<?php

namespace App\Imports;

use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use App\Models\Category;
use App\Models\Indikator;
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
            $evaluasiRekap = EvaluasiRekap::create([
                'category_id' => $category_id ,
            ]);
            $evaluasiRekapId = $evaluasiRekap->id;
            $indikators = Indikator::where('category_id', $category_id)->get();
            $index = 0;

            foreach ($row as $skor) {
                // Cari indikator berdasarkan urutan
                if (isset($indikators[$index])) {
                    $indikator = $indikators[$index];

                    Evaluasi::create([
                        'evaluasi_rekap_id' => $evaluasiRekapId, // Sesuaikan dengan request
                        'category_id' => $category_id,
                        'indikator_id' => $indikator->id,
                        'nama_indikator' => $indikator->nama_indikator,
                        'skor' => is_numeric($skor) ? (int)$skor : null,
                    ]);
                }
                $index++;
            }
        }
    }
}
