<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class paparana extends Model
{
    protected $table = 'paparan1';
    protected $fillable = [
        'PA1_ID', 'NIK', 'STATUS','NAMA','ALAMAT','HUBUNGAN','TGL_AWAL','TGL_AKHIR'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('paparan1')->orderBy('PA1_ID','DESC')->take(1)->get();
    }
}
