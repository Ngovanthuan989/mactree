<?php

namespace App\Exports;



use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\BeforeWriting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrderExportFromView implements FromView
{
    protected $orders;
    /**
    *
    * 2021-03-05
    *
    * @param object
    *
    * @author ntdat <datnt@baokim.vn>
    * @return
    */
    public function __construct($data)
    {
        $this->orders = $data;
    }

    /**
     * @inheritDoc
     */
    public function view(): View
    {
        return view('exports.order', [
            'data' => $this->orders
        ]);
    }

    /**
     * @inheritDoc
     */
    // public function columnFormats(): array
    // {
    //     return [
    //         'D' => NumberFormat::FORMAT_CURRENCY_VND,
    //         'E' => NumberFormat::FORMAT_NUMBER,
    //         'F' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
}
