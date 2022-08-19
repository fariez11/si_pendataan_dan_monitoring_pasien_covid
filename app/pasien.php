<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'NIK', 'NAMA', 'NAMA_ORTU','TGL_LAHIR','UMUR','UMUR_B','GENDER','PEKERJAAN','ALAMAT','RT','RW','DESA','KEC','KAB','NO_TELP','LONGITUDE','LATITUDE','KAT','TGL_RELEASE'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('pasien')->orderBy('NIK','DESC')->take(1)->get();
    }
}
