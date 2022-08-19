<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class penunjang extends Model
{
    protected $table = 'p_penunjang';
    protected $fillable = [
        'PENJ_ID', 'NIK','TGLA','TMPA','HSLA','TGLB','TMPB','HSLB','TGLC','TMPC','HSLC','TGLD','TMPD','HSLD','TGLE','TMPE','HSLE','TGLF','TMPF','HSLF','JNG','TGLG','TMPG','HSLG'
    ];

    public $timestamps = false;
    
    public static function getId(){
        return $getId = DB::table('p_penunjang')->orderBy('PENJ_ID','DESC')->take(1)->get();
    }
}
