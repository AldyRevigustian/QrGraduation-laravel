<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class RegistrasiExport implements FromView, WithEvents, ShouldAutoSize
{
    private $count;
    use RegistersEventListeners;

    public function view(): View
    {
        $siswas = Siswa::all();
        $this->count= count($siswas);

        return view('admin.registrasi.export', compact('siswas'));
    }

    public static function afterSheet(AfterSheet $event)
    {
        $siswas = Siswa::all();
        $count= count($siswas) + 1;

        $event->sheet->getDelegate()->getStyle('A1:F1')
            ->getFont()
            ->setBold(true)
            ->setSize(12);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Arial', 'size' => 13]
        ];

        $strikethrough = [
            'font' => ['strikethrough' => true],
        ];
        // $end = (int)$this->count + 5;

        $active_sheet = $event->sheet->getDelegate();
        $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
        $event->sheet->getColumnDimension('C')->setWidth('100');
        $event->sheet->getColumnDimension('C')->setWidth('100');
        $event->sheet->getDelegate()->getStyle("A1:F$count")->applyFromArray($styleArray);
        // $event->sheet->getColumnDimension('D')->setAutoSize(true) ;
        // $event->sheet->getColumnDimension('E')->setAutoSize(true) ;
        // $event->sheet->getColumnDimension('F')->setAutoSize(true) ;


        // Apply Style Arrays
        $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);
        $event->sheet->getDelegate()
            ->getStyle('A1:F1')
            ->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // $event->sheet->getDelegate()
        //     ->getStyle('A1:A3')
        //     ->getAlignment()
        //     ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)
        //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
}
