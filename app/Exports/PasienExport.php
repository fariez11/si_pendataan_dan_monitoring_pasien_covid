<?php

namespace App\Exports;

use App\Exports\PasienExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PasienExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
        public function __construct($hasil){
            $this->hasil = $hasil;        
        }

        public function view(): View{
            return view('exports.cetak',[
                'hasil' => $this->hasil
            ]);     
        }
    
}
