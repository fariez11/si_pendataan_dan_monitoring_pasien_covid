<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Session;
use File;
use DB;
use Illuminate\Http\Request;
use App\pengguna;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login()
    {   
        $idp = pengguna::getId();
        $sql = DB::SELECT("select*from pengguna where LEVEL = 'Admin'");
        return view('/login',['idp'=>$idp,'sql'=>$sql]);
    }

    public function regis(Request $request)
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
            $data->LEVEL = 'Admin';
            $data->FOTO = $foto;
            $data->save();

        return redirect()->back()->with('error','.');
    }

    public function actlog(Request $request){
        $username = $request->user;
        $password = $request->pass;
        
        Session::flush();
        $data = DB::table('pengguna')->where([['USERNAME',$username],['PASSWORD',$password]])->get();
        foreach ($data as $key) {
            $nama = $key->USERNAME;
            $level = $key->LEVEL;
        };

        if (count($data) == 0){
            return redirect('/')->with('gagal','.');
        }else{

	        if($level == 'Owner') {
	        	$na = DB::SELECT("select*from pengguna where USERNAME like '$username'");
	        	foreach ($na as $nam) {
                    Session::put('idp',$nam->PENG_ID);
	        		Session::put('nama',$username);
                    Session::put('nam',$nam->NAMA);
                    Session::put('email',$nam->EMAIL);
	        		Session::put('level',$nam->LEVEL);
	        	}

	            return redirect('/owner');
	        }
	        else if($level == 'Petugas') {

                // $na = DB::SELECT("select*from pengguna a, mhs b where a.USER_ID = b.USER_ID and a.USERNAME like '$username'");
                $na = DB::SELECT("select*from pengguna where USERNAME like '$username'");
	        	foreach ($na as $nam) {
                    Session::put('idp',$nam->PENG_ID);
	        		Session::put('nama',$username);
                    Session::put('nam',$nam->NAMA);
                    Session::put('email',$nam->EMAIL);
	        		Session::put('level',$nam->LEVEL);
                }

                return redirect('/petugas');

	        }else if($level == 'Admin') {

                // $na = DB::SELECT("select*from pengguna a, mhs b where a.USER_ID = b.USER_ID and a.USERNAME like '$username'");
                $na = DB::SELECT("select*from pengguna where USERNAME like '$username'");
                foreach ($na as $nam) {
                    Session::put('idp',$nam->PENG_ID);
                    Session::put('nama',$username);
                    Session::put('nam',$nam->NAMA);
                    Session::put('email',$nam->EMAIL);
                    Session::put('level',$nam->LEVEL);
                }

                return redirect('/admin');

            }
			else {

            return redirect('/')->with('error','.');
        	}
	    }

    }

    public function logout(){

        Session::flush();
        return redirect('/');
    }
}
