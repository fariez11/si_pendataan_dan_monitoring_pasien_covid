<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class kota extends Model
{
    protected $table = 'kota';
    protected $fillable = [
        'KOTA_ID', 'NAMA_KOTA'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('kota')->orderBy('KOTA_ID','DESC')->take(1)->get();
    }
}
