<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EvaluasiExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell, WithMapping, WithTitle, ShouldAutoSize
{
    protected $evaluasiList;
    protected $questions;

    public function __construct($evaluasiList, $questions)
    {
        $this->evaluasiList = $evaluasiList;
        $this->questions = $questions;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return collect($this->evaluasiList);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // First row
        $headings1 = ['Responden'];
        $headings1[] = 'Pertanyaan';
        for ($i = 1; $i < $this->questions->count(); $i++) {
            $headings1[] = '';
        }
        $headings1[] = 'Total';

        // Second row
        $headings2 = [''];
        for ($i = 1; $i <= $this->questions->count(); $i++) {
            $headings2[] = $i;
        }
        $headings2[] = '';

        return [$headings1, $headings2];
    }

    /**
     * @param mixed $evaluasi
     * @return array
     */
    public function map($evaluasi): array
    {
        static $no = 1;
        $row = ['Responden ' . $no++];

        foreach ($this->questions as $question) {
            $row[] = isset($evaluasi->{$question->id}) ? $evaluasi->{$question->id} : 0;
        }

        $row[] = $evaluasi->total;

        return $row;
    }

    /**
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Merge cells for first row headers
        $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($this->questions->count() + 1);
        $sheet->mergeCells('B1:' . $lastColumn . '1');

        // Style for headers
        $headerStyle = [
            'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '3C8DBC'],
            ],
            'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
            ],
        ];

        $totalColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($this->questions->count() + 2);
        $sheet->getStyle($totalColumn . '1')->applyFromArray($headerStyle);
        $sheet->getStyle($totalColumn . '2')->applyFromArray($headerStyle);

        // Apply styles
        $sheet->getStyle('A1:' . $lastColumn . '2')->applyFromArray($headerStyle);

        // Style for data cells
        $dataStyle = [
            'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
            ],
            ],
            'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $sheet->getStyle('A3:' . $lastColumn . $sheet->getHighestRow())->applyFromArray($dataStyle);

        $totalColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($this->questions->count() + 2);
        $sheet->getStyle($totalColumn . '3:' . $totalColumn . $sheet->getHighestRow())->applyFromArray($dataStyle);

        $totalColumnStyle = [
            'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'B7DEE8'],
            ],
        ];
        $sheet->getStyle($totalColumn . '3:' . $totalColumn . $sheet->getHighestRow())->applyFromArray($totalColumnStyle);
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A1';
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Laporan Evaluasi';
    }
}
