<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class paparanb extends Model
{
    protected $table = 'paparan2';
    protected $fillable = [
        'PA2_ID', 'NIK', 'ISPA','ST_HEWAN','ANJING','KUCING','S_HEWAN','PET_KES','APD1','APD2','APD3','APD4','APD5','APD6','TAPD','PROSEDUR','LAINNYA'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('paparan2')->orderBy('PA2_ID','DESC')->take(1)->get();
    }
}
