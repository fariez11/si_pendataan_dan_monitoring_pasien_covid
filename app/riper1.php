<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class riper1 extends Model
{
    protected $table = 'r_perj1';
    protected $fillable = [
        'PERJ1_ID', 'NIK', 'STATUS','NEGARA','KOTA','TGL_PERJ','TGL_TIBA'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('r_perj1')->orderBy('PERJ1_ID','DESC')->take(1)->get();
    }
}
