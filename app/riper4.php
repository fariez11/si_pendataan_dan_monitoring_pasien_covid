<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class riper4 extends Model
{
    protected $table = 'r_perj4';
    protected $fillable = [
        'PERJ4_ID', 'NIK', 'STATUS','NAMA','ALAMAT','HUBUNGAN','TGL_AWAL','TGL_AKHIR'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('r_perj4')->orderBy('PERJ4_ID','DESC')->take(1)->get();
    }
}
