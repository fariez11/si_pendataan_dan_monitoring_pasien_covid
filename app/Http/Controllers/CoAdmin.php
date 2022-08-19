<?php

namespace App\Http\Controllers;

use Session;
use File;
use Illuminate\Http\Request;
use App\Http\Requests;
use Authenticate;
use DB;
use App\pengguna;
use App\kelurahan;
use App\kecamatan;
use App\kota;
use App\tempat;

class CoAdmin extends Controller
{

	public function home()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $jpeng = DB::SELECT("select count(*) as jum from pengguna");
            $jkec = DB::SELECT("select count(*) as jum from kecamatan");
            $jkel = DB::SELECT("select count(*) as jum from kelurahan");
            $jtmp = DB::SELECT("select count(*) as jum from tempat_pemeriksaan");
            return view('/admin/home',['jpeng'=>$jpeng,'jkec'=>$jkec,'jkel'=>$jkel,'jtmp'=>$jtmp]);

        }
    }

    public function updadmin(Request $request,$id)
    {
        $na = $request->nama;
        $em = $request->email;
        $us = $request->user;
        $pa = $request->pass;
        $fo = $request->foto;


        if($request->file('foto')==null){

            $data = DB::table('pengguna')->where('PENG_ID',$id)->update(['NAMA'=>ucfirst($na),'EMAIL'=>$em,'USERNAME'=>$us,'PASSWORD'=>$pa]);


        }else{
            $gam = DB::SELECT("select*from pengguna where PENG_ID = '$id'");
            foreach ($gam as $key) {
                $image_path = "assets/foto/$key->FOTO";
                if(File::exists($image_path)) {
                File::delete($image_path);
                }
            }

                $photo_path=$request->file('foto');
                $m_path=$photo_path->getClientOriginalName();
                $photo_path->move('assets/foto/',$m_path);

            $data = DB::table('pengguna')->where('PENG_ID',$id)->update(['NAMA'=>ucfirst($na),'EMAIL'=>$em,'USERNAME'=>$us,'PASSWORD'=>$pa,'FOTO'=>"$m_path"]);

        }
        return redirect()->back()->with('addpeng','.');
    }


    public function dtapeng()
    {	
    	if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

        	$idp = pengguna::getId();
        	$data = DB::SELECT("select*from pengguna");
    	    return view('/admin/dt_pengguna',['data'=>$data,'idp'=>$idp]);

        }
    }

    public function addpeng(Request $request)
    {
        $id = $request->idp;
        $na = $request->nama;
        $em = $request->email;
        $us = $request->user;
        $pa = $request->pass;
        $le = $request->level;
        $fo = $request->foto;

        if($fo == null){
            $foto = 'defaultprofile.png';
        }else{
            $foto = $fo->getClientOriginalName();
            $request->file('foto')->move("assets/foto/", $foto);
        }

        $data = new pengguna();
            if($id == null){
                $data->PENG_ID = 1;
            }else{
                $data->PENG_ID = $id;
            }
            $data->NAMA = ucfirst($na);
            $data->EMAIL = $em;
            $data->USERNAME = $us;
            $data->PASSWORD = $pa;
            $data->LEVEL = $le;
            $data->FOTO = $foto;
            $data->save();

        return redirect('datapengguna')->with('addpeng','.');
    }

    public function updpeng(Request $request,$id)
    {
        $na = $request->nama;
        $em = $request->email;
        $us = $request->user;
        $pa = $request->pass;
        $le = $request->level;

            $data = DB::table('pengguna')->where('PENG_ID',$id)->update(['NAMA'=>ucfirst($na),'EMAIL'=>$em,'USERNAME'=>$us,'PASSWORD'=>$pa,'LEVEL'=>$le]);
        
        return redirect('datapengguna')->with('updpeng','.');
    }

    public function delpeng($id)
    {
        $data = DB::table('pengguna')->where('AKUN_ID',$id)->update(['HAPUS'=>'1']);

        return redirect('datapengguna')->with('delpeng','.');

    }


    public function dtakota()
    {	
    	if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

        	$idk = kota::getId();
        	$data = DB::SELECT("select*from kota");
    	    return view('/admin/dt_kota',['data'=>$data,'idk'=>$idk]);

        }
    }

    public function addkota(Request $request)
    {
        $id = $request->idk;
        $na = $request->nama;

        $data = new kota();
            if($id == null){
                $data->KOTA_ID = 1;
            }else{
                $data->KOTA_ID = $id;
            }
            $data->NAMA_KOTA = ucfirst($na);
            $data->save();

        return redirect('datakota')->with('addpeng','.');
    }

    public function updkota(Request $request,$id)
    {
        $id = $request->idk;
        $na = $request->nama;

            $data = DB::table('kota')->where('KOTA_ID',$id)->update(['NAMA_KOTA'=>ucfirst($na)]);
        
        return redirect('datakota')->with('updpeng','.');
    }

    public function delkota($id)
    {
        DB::table('kota')->where('KOTA_ID',$id)->delete();

        return redirect('datakota')->with('delpeng','.');

    }


    public function dtakec()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $idk = kecamatan::getId();
            $data = DB::SELECT("select*from kecamatan");
            return view('/admin/dt_kec',['data'=>$data,'idk'=>$idk]);

        }
    }

    public function addkec(Request $request)
    {
        $id = $request->idk;
        $na = $request->nama;

        $data = new kecamatan();
            if($id == null){
                $data->KEC_ID = 1;
            }else{
                $data->KEC_ID = $id;
            }
            $data->NAMA_KEC = ucfirst($na);
            $data->save();

        return redirect('datakecamatan')->with('addpeng','.');
    }

    public function updkec(Request $request,$id)
    {
        $na = $request->nama;

            $data = DB::table('kecamatan')->where('KEC_ID',$id)->update(['NAMA_KEC'=>ucfirst($na)]);
        
        return redirect('datakecamatan')->with('updpeng','.');
    }

    public function delkec($id)
    {
        DB::table('kecamatan')->where('KEC_ID',$id)->delete();

        return redirect('datakecamatan')->with('delpeng','.');

    }



    public function dtakel()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $idk = kelurahan::getId();
            $data = DB::SELECT("select*from kelurahan");
            return view('/admin/dt_kel',['data'=>$data,'idk'=>$idk]);

        }
    }

    public function addkel(Request $request)
    {
        $id = $request->idk;
        $na = $request->nama;

        $data = new kelurahan();
            if($id == null){
                $data->KEL_ID = 1;
            }else{
                $data->KEL_ID = $id;
            }
            $data->KELURAHAN = ucfirst($na);
            $data->save();

        return redirect('datakelurahan')->with('addpeng','.');
    }

    public function updkel(Request $request,$id)
    {
        $na = $request->nama;

        $data = DB::table('kelurahan')->where('KEL_ID',$id)->update(['KELURAHAN'=>ucfirst($na)]);
        
        return redirect('datakelurahan')->with('updpeng','.');
    }

    public function delkel($id)
    {
        DB::table('kelurahan')->where('KEL_ID',$id)->delete();

        return redirect('datakelurahan')->with('delpeng','.');
    }

    public function dtatmp()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $idt = tempat::getId();
            $data = DB::SELECT("select*from tempat_pemeriksaan");
            return view('/admin/dt_tmp',['data'=>$data,'idt'=>$idt]);

        }
    }

    public function addtmp(Request $request)
    {
        $id = $request->idt;
        $na = $request->nama;

        $data = new tempat();
            if($id == null){
                $data->TMP_ID = 1;
            }else{
                $data->TMP_ID = $id;
            }
            $data->NAMA_TEMPAT = ucfirst($na);
            $data->save();

        return redirect('datatempat')->with('addpeng','.');
    }

    public function updtmp(Request $request,$id)
    {
        $na = $request->nama;

        $data = DB::table('tempat_pemeriksaan')->where('TMP_ID',$id)->update(['NAMA_TEMPAT'=>ucfirst($na)]);
        
        return redirect('datatempat')->with('updpeng','.');
    }

    public function deltmp($id)
    {
        DB::table('tempat_pemeriksaan')->where('TMP_ID',$id)->delete();

        return redirect('datatempat')->with('delpeng','.');

    }
}
