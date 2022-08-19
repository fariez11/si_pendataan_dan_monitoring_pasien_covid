<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class klinis extends Model
{
    protected $table = 'klinis';
    protected $fillable = [
        'KLINIS_ID', 'NIK', 'TGL_GEJALA','DEMAM','RI_DEMAM','BATUK','PILEK','S_TENGGOROKAN','S_NAFAS','S_KEPALA','LEMAH','NYERI_OTOT','MUAL','ABDOMEN','DIARE','LAINNYA','HAMIL','DIABETES','S_JANTUNG','HIPERTENSI','KEGANASAN','G_IMUNOLOGI','G_GINJAL','G_HATI','PPOK','LAINNYA2','DIAG_1','DIAG_2','DIAG_3','DIAG_4','DIAG_5','NAMA_RS','MASUK_RS','TGL'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('klinis')->orderBy('KLINIS_ID','DESC')->take(1)->get();
    }
}
