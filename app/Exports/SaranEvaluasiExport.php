<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;

class SaranEvaluasiExport implements FromView, ShouldAutoSize
{
    protected $sarans;
    protected $category;

    public function __construct($sarans, $category)
    {
        $this->sarans = $sarans;
        $this->category = $category;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('export.laporan-survey.saran', [
            'sarans' => $this->sarans,
            'category' => $this->category,
        ]);
    }
}
