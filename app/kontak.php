<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class kontak extends Model
{
    protected $table = 'kontak';
    protected $fillable = [
        'KONTAK_ID', 'NIK', 'NAMA','UMUR','GENDER','HUBUNGAN','ALAMAT','NO_TELP','AKTIVITAS'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('kontak')->orderBy('KONTAK_ID','DESC')->take(1)->get();
    }
}
