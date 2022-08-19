<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class riper3 extends Model
{
    protected $table = 'r_perj3';
    protected $fillable = [
        'PERJ3_ID', 'NIK', 'STATUS','PROV','KOTA'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('r_perj3')->orderBy('PERJ3_ID','DESC')->take(1)->get();
    }
}
