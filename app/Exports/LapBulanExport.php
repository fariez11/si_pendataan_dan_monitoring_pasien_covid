<?php

namespace App\Exports;

use App\Exports\LapBulanExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LapBulanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($bln,$thn){
        $this->bln = $bln;
        $this->thn = $thn;
    }

    public function view(): View{
        return view('exports.laporanperbulan',[
            'bln' => $this->bln,
            'thn' => $this->thn
        ]);     
    }
}
