<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $fillable = [
        'KEC_ID', 'NAMA_KEC'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('kecamatan')->orderBy('KEC_ID','DESC')->take(1)->get();
    }
}
