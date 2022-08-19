<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class riper2 extends Model
{
    protected $table = 'r_perj2';
    protected $fillable = [
        'PERJ2_ID', 'NIK', 'STATUS','PROV','KOTA','TGL_PERJ','TGL_TIBA'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('r_perj2')->orderBy('PERJ2_ID','DESC')->take(1)->get();
    }
}
