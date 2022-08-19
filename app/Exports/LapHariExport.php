<?php

namespace App\Exports;

use App\Exports\LapHariExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LapHariExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
        public function __construct($ta,$tb){
            $this->ta = $ta;
            $this->tb = $tb;
        }

        public function view(): View{
            return view('exports.laporanperhari',[
                'ta' => $this->ta,
                'tb' => $this->tb
            ]);     
        }
    
}
