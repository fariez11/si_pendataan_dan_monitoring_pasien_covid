<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;


class CoOwner extends Controller
{
    public function home()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

	       return view('/owner/home');

        }
    }


    public function laporan()
    {	
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $now = Carbon::now();
    		$sen = $now->startOfWeek()->format('Y-m-d');
    		$min = $now->endOfWeek()->format('Y-m-d');
        	$curmonth = date('m');

        	$k1ab = DB::SELECT("select count(*)as jum from pasien where KAT = 'Suspek' and TGL_RELEASE between '$sen' and '$min'");
        	$k1ac = DB::SELECT("select count(*)as jum from pasien where KAT = 'Suspek' and MONTH(TGL_RELEASE) = '$curmonth'");
        	$k1bb = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Probabel' and TGL_RELEASE between '$sen' and '$min'");
        	$k1bc = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Probabel' and MONTH(TGL_RELEASE) = '$curmonth'");

        	$k2ab = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Konfirmasi' and TGL_RELEASE between '$sen' and '$min'");
        	$k2ac = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Konfirmasi' and MONTH(TGL_RELEASE) = '$curmonth'");
        	$k2bb = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Terkena Gejala' and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE between '$sen' and '$min'");
        	$k2bc = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Terkena Gejala' and a.KAT = 'Kasus Konfirmasi' and MONTH(a.TGL_RELEASE) = '$curmonth'");
        	$k2ca = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Tanpa Gejala' and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE = '$now'");
            $k2cb = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Tanpa Gejala' and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE between '$sen' and '$min'");
        	$k2cc = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Tanpa Gejala' and a.KAT = 'Kasus Konfirmasi' and MONTH(a.TGL_RELEASE) = '$curmonth'");
            $k2db = DB::SELECT("select count(*)as jum from pasien a, r_perj1 b where a.NIK = b.NIK and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE between '$sen' and '$min'");
            $k2dc = DB::SELECT("select count(*)as jum from pasien a, r_perj1 b where a.NIK = b.NIK and a.KAT = 'Kasus Konfirmasi' and MONTH(a.TGL_RELEASE) = '$curmonth'");

            $k5ab = DB::SELECT("select count(*)as jum from pasien a, p_penunjang b where a.NIK = b.NIK and a.TGL_RELEASE between '$sen' and '$min'");
            $k5ac = DB::SELECT("select count(*)as jum from pasien a, p_penunjang b where a.NIK = b.NIK and MONTH(a.TGL_RELEASE) = '$curmonth'");



    	    return view('/owner/laporan',[
    	    	'k1ab'=>$k1ab,'k1ac'=>$k1ac,
    	    	'k1bb'=>$k1bb,'k1bc'=>$k1bc,

    	    	'k2ab'=>$k2ab,'k2ac'=>$k2ac,
    	    	'k2bb'=>$k2bb,'k2bc'=>$k2bc,
    	    	'k2ca'=>$k2ca,'k2cb'=>$k2cb,'k2cc'=>$k2cc,
                'k2db'=>$k2db,'k2dc'=>$k2dc,


                'k5ab'=>$k2ab,'k5ac'=>$k2ac,
    	    ]);

        }
    }

    public function flaporan()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $now = Carbon::now();
            $sen = $now->startOfWeek()->format('Y-m-d');
            $min = $now->endOfWeek()->format('Y-m-d');
            $curmonth = date('m');

            $k1ab = DB::SELECT("select count(*)as jum from pasien where KAT = 'Suspek' and TGL_RELEASE between '$sen' and '$min'");
            $k1ac = DB::SELECT("select count(*)as jum from pasien where KAT = 'Suspek' and MONTH(TGL_RELEASE) = '$curmonth'");
            $k1bb = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Probabel' and TGL_RELEASE between '$sen' and '$min'");
            $k1bc = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Probabel' and MONTH(TGL_RELEASE) = '$curmonth'");

            $k2ab = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Konfirmasi' and TGL_RELEASE between '$sen' and '$min'");
            $k2ac = DB::SELECT("select count(*)as jum from pasien where KAT = 'Kasus Konfirmasi' and MONTH(TGL_RELEASE) = '$curmonth'");
            $k2bb = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Terkena Gejala' and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE between '$sen' and '$min'");
            $k2bc = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Terkena Gejala' and a.KAT = 'Kasus Konfirmasi' and MONTH(a.TGL_RELEASE) = '$curmonth'");
            $k2ca = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Tanpa Gejala' and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE = '$now'");
            $k2cb = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Tanpa Gejala' and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE between '$sen' and '$min'");
            $k2cc = DB::SELECT("select count(*)as jum from pasien a, klinis b where a.NIK = b.NIK and b.STATUS = 'Tanpa Gejala' and a.KAT = 'Kasus Konfirmasi' and MONTH(a.TGL_RELEASE) = '$curmonth'");
            $k2db = DB::SELECT("select count(*)as jum from pasien a, r_perj1 b where a.NIK = b.NIK and a.KAT = 'Kasus Konfirmasi' and a.TGL_RELEASE between '$sen' and '$min'");
            $k2dc = DB::SELECT("select count(*)as jum from pasien a, r_perj1 b where a.NIK = b.NIK and a.KAT = 'Kasus Konfirmasi' and MONTH(a.TGL_RELEASE) = '$curmonth'");

            $k5ab = DB::SELECT("select count(*)as jum from pasien a, p_penunjang b where a.NIK = b.NIK and a.TGL_RELEASE between '$sen' and '$min'");
            $k5ac = DB::SELECT("select count(*)as jum from pasien a, p_penunjang b where a.NIK = b.NIK and MONTH(a.TGL_RELEASE) = '$curmonth'");



            return view('/owner/flaporan',[
                'k1ab'=>$k1ab,'k1ac'=>$k1ac,
                'k1bb'=>$k1bb,'k1bc'=>$k1bc,

                'k2ab'=>$k2ab,'k2ac'=>$k2ac,
                'k2bb'=>$k2bb,'k2bc'=>$k2bc,
                'k2ca'=>$k2ca,'k2cb'=>$k2cb,'k2cc'=>$k2cc,
                'k2db'=>$k2db,'k2dc'=>$k2dc,


                'k5ab'=>$k2ab,'k5ac'=>$k2ac,
            ]);

        }
    }



    public function laphari(Request $request)
    {  
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $tga = $request->tgla;

            if($tga == null){

                $tga = date('Y-m-d');
                $tgb = date('Y-m-d');


                $ka1a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND b.TGL_RELEASE = '$tga'");
                $ka1b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.TGL_RELEASE = '$tga'");
                $ka1c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Isolasi' AND b.TGL_RELEASE = '$tga'");
                $ka1d= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE = '$tga'");


                $ka2a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.TGL_RELEASE = '$tga'");
                $ka2b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Terkena Gejala' AND b.TGL_RELEASE = '$tga'");
                $ka2c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Tanpa Gejala' AND b.TGL_RELEASE = '$tga'");
                $ka2d= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.TGL_RELEASE = '$tga'");


                $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND b.TGL_RELEASE = '$tga'");


                $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE = '$tga'");



                $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND b.TGL_RELEASE = '$tga'");



                $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND b.TGL_RELEASE = '$tga'");

            }else{

                $tga = $request->tgla;
                $tgb = $request->tglb;

                $ka1a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");
                $ka1b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");
                $ka1c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Isolasi' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");
                $ka1d= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");


                $ka2a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");
                $ka2b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Terkena Gejala' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");
                $ka2c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Tanpa Gejala' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");
                $ka2d= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");


                $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");


                $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");



                $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");



                $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");

            }


            return view('/owner/lp_perhari',[
                'tga'=>$tga,
                'tgb'=>$tgb,

                'ka1a'=>$ka1a,
                'ka1b'=>$ka1b,
                'ka1c'=>$ka1c,
                'ka1d'=>$ka1d,

                'ka2a'=>$ka2a,
                'ka2b'=>$ka2b,
                'ka2c'=>$ka2c,
                'ka2d'=>$ka2d,

                'ka2g'=>$ka2g,

                'ka3f'=>$ka3f,

                'ka4b'=>$ka4b,

                'ka5a'=>$ka5a,
            ]);

        }
    }




    public function lapbulan(Request $request)
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $bulan = array ( 
                [ 'id' => 1,'bulan' => 'Januari' ],
                [ 'id' => 2,'bulan' => 'Februari' ],
                [ 'id' => 3,'bulan' => 'Maret' ],
                [ 'id' => 4,'bulan' => 'April' ],
                [ 'id' => 5,'bulan' => 'Mei' ],
                [ 'id' => 6,'bulan' => 'Juni' ],
                [ 'id' => 7,'bulan' => 'Juli' ],
                [ 'id' => 8,'bulan' => 'Agustus' ],
                [ 'id' => 9,'bulan' => 'September' ],
                [ 'id' => 10,'bulan' => 'Oktober' ],
                [ 'id' => 11,'bulan' => 'November' ],
                [ 'id' => 12,'bulan' => 'Desember' ]
            );

            $cbbln = $request->bulan;

            if($cbbln == null){

                $cbbln = date('m');
                $cbthn = date('Y');

                $ka1a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka1b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka1c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Isolasi' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka1d= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Discarder' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka2a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka2b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Terkena Gejala' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka2c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Tanpa Gejala' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka2d= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");



                $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");



                $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");

            }else{

                $cbbln = $request->bulan;
                $cbthn = $request->tahun;

                $ka1a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka1b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka1c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Isolasi' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka1d= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Discarder' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka2a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka2b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Terkena Gejala' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka2c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Tanpa Gejala' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");
                $ka2d= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");



                $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");



                $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");

            }
            
            

            return view('/owner/lp_perbulan',[
                
                'bulan'=>$bulan,
                'cbbln'=>$cbbln,
                'cbthn'=>$cbthn,

                'ka1a'=>$ka1a,
                'ka1b'=>$ka1b,
                'ka1c'=>$ka1c,
                'ka1d'=>$ka1d,


                'ka2a'=>$ka2a,
                'ka2b'=>$ka2b,
                'ka2c'=>$ka2c,
                'ka2d'=>$ka2d,


                'ka2g'=>$ka2g,

                'ka3f'=>$ka3f,
                

                'ka4b'=>$ka4b,

                'ka5a'=>$ka5a,
            ]);

        }
    }


    
}
