<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class tempat extends Model
{
    protected $table = 'tempat_pemeriksaan';
    protected $fillable = [
        'TMP_ID', 'NAMA_TEMPAT'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('tempat_pemeriksaan')->orderBy('TMP_ID','DESC')->take(1)->get();
    }
}
