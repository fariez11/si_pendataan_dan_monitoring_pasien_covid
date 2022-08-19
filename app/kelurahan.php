<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class kelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $fillable = [
        'KEL_ID', 'KELURAHAN'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('kelurahan')->orderBy('KEL_ID','DESC')->take(1)->get();
    }
}
