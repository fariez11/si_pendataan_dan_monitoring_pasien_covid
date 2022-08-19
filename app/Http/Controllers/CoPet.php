<?php

namespace App\Http\Controllers;

use Session;
use File;
use Authenticate;
use DB;
use Carbon\Carbon;
use App\Exports\PasienExport;
use App\Exports\LapHariExport;
use App\Exports\LapBulanExport;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Concerns\FROMCollection;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\pengguna;
use App\pasien;
use App\kontak;
use App\klinis;
use App\penunjang;
use App\riper1;
use App\riper2;
use App\riper3;
use App\riper4;
use App\paparana;
use App\paparanb;
use App\kelurahan;
use App\kecamatan;
use App\kota;
use App\tempat;

class CoPet extends Controller
{
    public function home()
    {
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

	        $jpsn = DB::SELECT("SELECT count(*) as jum FROM pasien");
            $jkli = DB::SELECT("SELECT count(*) as jum FROM klinis");
            $jppn = DB::SELECT("SELECT count(*) as jum FROM p_penunjang");
            $jkte = DB::SELECT("SELECT count(*) as jum FROM kontak");
            return view('/petugas/home',['jpsn'=>$jpsn,'jkli'=>$jkli,'jppn'=>$jppn,'jkte'=>$jkte]);

        }
    }

    public function updpet(Request $request,$id)
    {
        $na = $request->nama;
        $em = $request->email;
        $us = $request->user;
        $pa = $request->pass;
        $fo = $request->foto;


        if($request->file('foto')==null){

            $data = DB::table('pengguna')->WHERE('PENG_ID',$id)->update(['NAMA'=>ucfirst($na),'EMAIL'=>$em,'USERNAME'=>$us,'PASSWORD'=>$pa]);


        }else{
            $gam = DB::SELECT("SELECT*FROM pengguna WHERE PENG_ID = '$id'");
            foreach ($gam as $key) {
                $image_path = "assets/foto/$key->FOTO";
                if(File::exists($image_path)) {
                File::delete($image_path);
                }
            }

                $photo_path=$request->file('foto');
                $m_path=$photo_path->getClientOriginalName();
                $photo_path->move('assets/foto/',$m_path);

            $data = DB::table('pengguna')->WHERE('PENG_ID',$id)->update(['NAMA'=>ucfirst($na),'EMAIL'=>$em,'USERNAME'=>$us,'PASSWORD'=>$pa,'FOTO'=>"$m_path"]);

        }
        return redirect()->back()->with('addpeng','.');
    }

    public function dtapas()
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{

            $idp = pasien::getId();
            $kelurahan = DB::SELECT("SELECT*FROM kelurahan");
            $kecamatan = DB::SELECT("SELECT*FROM kecamatan");
            $kota = DB::SELECT("SELECT*FROM kota");
            $data = DB::SELECT("SELECT*FROM pasien a, kelurahan b, kecamatan c, kota d WHERE a.KEL_ID = b.KEL_ID AND a.KEC_ID = c.KEC_ID AND a.KOTA_ID = d.KOTA_ID");
            return view('/petugas/dt_pasien',['data'=>$data,'idp'=>$idp,'kel'=>$kelurahan,'kec'=>$kecamatan,'kota'=>$kota]);

        }
    }

    public function cetakpas(Request $request)
    {
        $pr = $request->per;
        $bl = $request->bulan;
        $th = $request->tahun;
        $ta = $request->tgla;
        $tb = $request->tglb;

        if($pr == 'Bulan'){
            
            $hasil = DB::SELECT("SELECT*FROM pasien a, kecamatan b, kelurahan c, klinis d WHERE a.KEC_ID = b.KEC_ID AND a.KEL_ID = c.KEL_ID AND a.NIK = d.NIK  AND MONTH(d.TGL_RELEASE) = '$bl' AND YEAR(TGL_RELEASE) = '$th'");

        }else if($pr == 'Hari'){
            
            $hasil = DB::SELECT("SELECT*FROM pasien a, kecamatan b, kelurahan c, klinis d WHERE a.KEC_ID = b.KEC_ID AND a.KEL_ID = c.KEL_ID AND a.NIK = d.NIK AND DATE(d.TGL_RELEASE) BETWEEN '$ta' AND '$tb'");

        }

        return Excel::download(new PasienExport($hasil), 'pasien.xlsx');

    }

    public function kerpas($id)
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{
            $nid = $id;
            $idk = kontak::getId();
            $pas = DB::SELECT("SELECT*FROM pasien WHERE NIK = '$id'");
            $data = DB::SELECT("SELECT*FROM kontak WHERE NIK = '$id'");
            return view('/petugas/dt_kontakerat',['nid' => $nid,'data'=>$data,'idk'=>$idk,'pas'=>$pas]);

        }
    }

    public function addpas(Request $request)
    {
        $ni = $request->nik;
        $na = $request->nama;
        $or = $request->ortu;
        $tl = $request->tgl;
        $um = $request->umur;
        $bl = $request->bln;
        $ge = $request->gend;
        $ke = $request->kerja;
        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $de = $request->kel;
        $kec = $request->kec;
        $ka = $request->kot;
        $no = $request->no;
        $ln = $request->lng;
        $la = $request->lat;
        $kat = $request->kat;
        $ket = $request->ket;

       $data = new pasien();
        $data->NIK = $ni;
        $data->NAMA = ucfirst($na);
        $data->NAMA_ORTU = ucfirst($or);
        $data->TGL_LAHIR = $tl;
        $data->UMUR = $um;
        $data->UMUR_B = $bl;
        $data->GENDER = $ge;
        $data->PEKERJAAN = $ke;
        $data->ALAMAT = $al;
        $data->RT = $rt;
        $data->RW = $rw;
        $data->KEL_ID = $de;
        $data->KEC_ID = $kec;
        $data->KOTA_ID = $ka;
        $data->NO_TELP = $no;
        $data->LONGITUDE = $ln;
        $data->LATITUDE = $la;
        $data->KAT = ucfirst($kat);
        $data->KET = ucfirst($ket);
        $data->save();

        return redirect('datapasien')->with('addpas','.');
    }

    public function edpas($id)
    {
        $kelurahan = DB::SELECT("SELECT*FROM kelurahan");
        $kecamatan = DB::SELECT("SELECT*FROM kecamatan");
        $kota = DB::SELECT("SELECT*FROM kota");
        $ed = DB::SELECT("SELECT*FROM pasien WHERE NIK = '$id'");

         return view('/petugas/ed_pasien',['ed'=>$ed,'kel'=>$kelurahan,'kec'=>$kecamatan,'kota'=>$kota]);

    } 

    public function updpas(Request $request,$id)
    {
        $ni = $request->nik;
        $na = $request->nama;
        $or = $request->ortu;
        $tl = $request->tgl;
        $um = $request->umur;
        $bl = $request->bln;
        $ge = $request->gend;
        $ke = $request->kerja;
        $al = $request->alam;
        $rt = $request->rt;
        $rw = $request->rw;
        $de = $request->kel;
        $kec = $request->kec;
        $ka = $request->kot;
        $no = $request->no;
        $ln = $request->lng;
        $la = $request->lat;
        $kat = $request->kat;
        $tr = $request->tgr;
        $ket = $request->ket;

            $data = DB::table('pasien')->WHERE('NIK',$ni)->update(['NAMA'=>ucfirst($na),'NAMA_ORTU'=>$or,'TGL_LAHIR'=>$tl,'UMUR'=>$um,'UMUR_B'=>$bl,'GENDER'=>$ge,'PEKERJAAN'=>$ke,'ALAMAT'=>$al,'RT'=>$rt,'RW'=>$rw,'KEL_ID'=>$de,'KEC_ID'=>$kec,'KOTA_ID'=>$ka,'NO_TELP'=>$no,'LONGITUDE'=>$ln,'LATITUDE'=>$la,'KAT'=>$kat,'KET'=>$ket]);
        
        return redirect('datapasien')->with('updpas','.');
    }

    public function delpas($id)
    {
        DB::table('pasien')->WHERE('NIK',$id)->delete();

        return redirect('datapasien')->with('delpas','.');
    }

    public function addkon(Request $request)
    {   
        $id = $request->idk;
        $aa = $request->nik;
        $ab = $request->nam;
        $ac = $request->umur;
        $ad = $request->gend;
        $ae = $request->hub;
        $af = $request->alam;
        $ag = $request->no;
        $ah = $request->akt;


       $data = new kontak();
       if($id == null){
            $data->KONTAK_ID = 1;
        }else{
            $data->KONTAK_ID = $id;
        }
        $data->NIK = $aa;
        $data->NAMA = $ab;
        $data->UMUR = $ac;
        $data->GENDER = $ad;
        $data->HUBUNGAN = $ae;
        $data->ALAMAT = $af;
        $data->NO_TELP = $ag;
        $data->AKTIVITAS = $ah;
        $data->save();

        return redirect()->back()->with('addkli','.');
    }

    public function updkon(Request $request,$id)
    {
        $ab = $request->nam;
        $ac = $request->umur;
        $ad = $request->gend;
        $ae = $request->hub;
        $af = $request->alam;
        $ag = $request->no;
        $ah = $request->akt;

            $data = DB::table('kontak')->WHERE('KONTAK_ID',$id)->update(['NAMA'=>ucfirst($ab),'UMUR'=>$ac,'GENDER'=>$ad,'HUBUNGAN'=>$ae,'ALAMAT'=>ucfirst($af),'NO_TELP'=>$ag,'AKTIVITAS'=>$ah]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function delkon($id)
    {
        DB::table('kontak')->WHERE('KONTAK_ID',$id)->delete();

        return redirect()->back()->with('delpas','.');
    }




    public function dtakli($id)
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{
            $nid = $id;
            $idk = klinis::getId();
            $data = DB::SELECT("SELECT*FROM pasien a, klinis b WHERE a.NIK = '$id' AND b.NIK = '$id'");
            $pas = DB::SELECT("SELECT*FROM pasien WHERE NIK = '$id'");
            return view('/petugas/dt_klinis',['nid' =>$nid,'idk'=>$idk,'data'=>$data,'pas'=>$pas]);

        }
    }

    public function addkli(Request $request)
    {   
        $id = $request->idk;
        $aa = $request->nik;
        $ab = $request->tgl;
        $ac = $request->dece;
        $ad = $request->ride;
        $st = $request->status;
        $ae = $request->batuk;
        $af = $request->pilek;
        $ag = $request->sate;
        $ah = $request->sena;
        $ai = $request->sake;
        $aj = $request->lema;
        $ak = $request->nyeri;
        $al = $request->mual;
        $am = $request->lain1;
        $an = $request->abdo;
        $ao = $request->diar;

        $b1 = $request->hamil;
        $b2 = $request->diab;
        $b3 = $request->peja;
        $b4 = $request->hipe;
        $b5 = $request->kega;
        $b6 = $request->gaim;
        $b7 = $request->ggk;
        $b8 = $request->ghk;
        $b9 = $request->ppok;
        $b10 = $request->lain2;

        $ca = $request->pkr;
        $cb = $request->ards;
        $cc = $request->lain3;
        $cd = $request->apa;
        $ce = $request->lain4;

        $da = $request->srs;
        $db = $request->nrs;
        $dc = $request->tgs;



       $data = new klinis();
       if($id == null){
            $data->KLINIS_ID = 1;
        }else{
            $data->KLINIS_ID = $id;
        }
        $data->NIK = $aa;
        $data->TGL_GEJALA = $ab;
        $data->DEMAM = $ac;
        if($ad == null){
            $data->RI_DEMAM = 'Tidak';
        }else{
             $data->RI_DEMAM = 'Ya';
        }
        $data->STATUS = $st;
        $data->BATUK = $ae;
        $data->PILEK = $af;
        $data->S_TENGGOROKAN = $ag;
        $data->S_NAFAS = $ah;
        $data->S_KEPALA = $ai;
        $data->LEMAH = $aj;
        $data->NYERI_OTOT = $ak;
        $data->MUAL = $al;
        $data->ABDOMEN = $an;
        $data->DIARE = $ao;
        $data->LAINNYA = $am;

        $data->HAMIL = $b1;
        $data->DIABETES = $b2;
        $data->S_JANTUNG = $b3;
        $data->HIPERTENSI = $b4;
        $data->KEGANASAN = $b5;
        $data->G_IMUNOLOGI = $b6;
        $data->G_GINJAL = $b7;
        $data->G_HATI = $b8;
        $data->PPOK = $b9;
        $data->LAINNYA2 = $b10;

        $data->DIAG_1 = $ca;
        $data->DIAG_2 = $cb;
        $data->DIAG_3 = $cc;
        $data->DIAG_4 = $cd;
        $data->DIAG_5 = $ce;

        $data->ST_RS = $da;
        $data->NAMA_RS = $db;
        $data->MASUK_RS = $dc;
        $data->save();

        return redirect()->back()->with('addkli','.');
    }

    public function edkli($id)
    {
        $pas = DB::SELECT("SELECT*FROM pasien");
        $tempat = DB::SELECT("SELECT*FROM tempat_pemeriksaan");
        $data = DB::SELECT("SELECT*FROM pasien a, klinis b WHERE a.NIK = b.NIK AND b.KLINIS_ID = '$id'");

        return view('/petugas/ed_klinis',['data'=>$data,'tmp'=>$tempat,'pas'=>$pas]);

    } 

    public function updkli(Request $request,$id)
    {
        $ni = $request->nik;
        $ab = $request->tgl;
        $ac = $request->dece;
        $rd = $request->ride;
        if($rd == null){
            $ad = 'Tidak';
        }else{
             $ad = 'Ya';
        }
        $st = $request->status;
        $re = $request->release;
        $stp = $request->stp;
        $ts = $request->tsp;

        if($st == 'Terkena Gejala'){
            $ae = $request->batuk;
            $af = $request->pilek;
            $ag = $request->sate;
            $ah = $request->sena;
            $ai = $request->sake;
            $aj = $request->lema;
            $ak = $request->nyeri;
            $al = $request->mual;
            $am = $request->lain1;
            $an = $request->abdo;
            $ao = $request->diar;
        }else{
            $ae = null;
            $af = null;
            $ag = null;
            $ah = null;
            $ai = null;
            $aj = null;
            $ak = null;
            $al = null;
            $am = null;
            $an = null;
            $ao = null;
        }

        $b1 = $request->hamil;
        $b2 = $request->diab;
        $b3 = $request->peja;
        $b4 = $request->hipe;
        $b5 = $request->kega;
        $b6 = $request->gaim;
        $b7 = $request->ggk;
        $b8 = $request->ghk;
        $b9 = $request->ppok;
        $b10 = $request->lain2;

        $ca = $request->pkr;
        $cb = $request->ards;
        $cc = $request->lain3;
        $cd = $request->apa;
        $ce = $request->lain4;

        $dc = $request->srs;

        if($dc == 'Ya'){  
            $da = $request->nrs;
            $db = $request->tglr;
        }else{
            $da = null;
            $db = null;
        }

        $data = DB::table('klinis')->WHERE('KLINIS_ID',$id)->update(['TGL_GEJALA'=>$ab,'DEMAM'=>$ac,'RI_DEMAM'=>$ad,'STATUS'=>$st,'BATUK'=>$ae,'PILEK'=>$af,'S_TENGGOROKAN'=>$ag,'S_NAFAS'=>$ah,'S_KEPALA'=>$ai,'LEMAH'=>$aj,'NYERI_OTOT'=>$ak,'MUAL'=>$al,'ABDOMEN'=>$an,'DIARE'=>$ao,'LAINNYA'=>$am,'HAMIL'=>$b1,'DIABETES'=>$b2,'S_JANTUNG'=>$b3,'HIPERTENSI'=>$b4,'KEGANASAN'=>$b5,'G_IMUNOLOGI'=>$b6,'G_GINJAL'=>$b7,'G_HATI'=>$b8,'PPOK'=>$b9,'LAINNYA2'=>$b10,'DIAG_1'=>$ca,'DIAG_2'=>$cb,'DIAG_3'=>$cc,'DIAG_4'=>$cd,'DIAG_5'=>$ce,'ST_RS'=>$dc,'NAMA_RS'=>$da,'MASUK_RS'=>$db,'TGL_RELEASE'=>$re,'ST_PASIEN'=>$stp,'TGL_STATUS'=>$ts]);
    
        // return redirect('dataklinis')->with('updpas','.');
         return redirect('pasien:kl='.$ni);
    }

    public function delkli($id)
    {
        DB::table('klinis')->WHERE('KLINIS_ID',$id)->delete();

        return redirect()->back()->with('addkli','.');

    }

    public function dtapen($id)
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{
            $nid = $id;
            $idp = penunjang::getId();
            $data = DB::SELECT("SELECT*FROM pasien a, p_penunjang b WHERE a.NIK = '$id' AND b.NIK = '$id'");
            $pas = DB::SELECT("SELECT*FROM pasien WHERE NIK = '$id'");
            $tempat = DB::SELECT("SELECT*FROM tempat_pemeriksaan");
            return view('/petugas/dt_penunjang',['nid'=>$nid,'data'=>$data,'idp'=>$idp,'pas'=>$pas,'tmp'=>$tempat]);

        }
    }

    public function addpp(Request $request)
    {
        $id = $request->idp;
        $ni = $request->nik;
        $tg1 = $request->tg1;
        $tp1 = $request->tp1;
        $hs1 = $request->hs1; 
        $tg2 = $request->tg2;
        $tp2 = $request->tp2;
        $hs2 = $request->hs2; 
        $tg3 = $request->tg3;
        $tp3 = $request->tp3;
        $hs3 = $request->hs3; 
        $tg4 = $request->tg4;
        $tp4 = $request->tp4;
        $hs4 = $request->hs4;
        $tg5 = $request->tg5;
        $tp5 = $request->tp5;
        $hs5 = $request->hs5; 
        $tg6 = $request->tg6;
        $tp6 = $request->tp6;
        $hs6 = $request->hs6; 
        $jn7 = $request->jn7;
        $tg7 = $request->tg7;
        $tp7 = $request->tp7;
        $hs7 = $request->hs7;
     
        $data = new penunjang();
        if($id == null){
            $data->PENJ_ID = 1;
        }else{
            $data->PENJ_ID = $id;
        }
        $data->NIK  = $ni;
        $data->TGLA = $tg1;
        $data->TMPA = $tp1;
        $data->HSLA = $hs1;
        $data->TGLB = $tg2;
        $data->TMPB = $tp2;
        $data->HSLB = ucfirst($hs2);
        $data->TGLC = $tg3;
        $data->TMPC = $tp3;
        $data->HSLC = ucfirst($hs3);
        $data->TGLD = $tg4;
        $data->TMPD = $tp4;
        $data->HSLD = ucfirst($hs4);
        $data->TGLE = $tg5;
        $data->TMPE = $tp5;
        $data->HSLE = $hs5;
        $data->TGLF = $tg6;
        $data->TMPF = $tp6;
        $data->HSLF = $hs6;
        $data->JNG  = ucfirst($jn7);
        $data->TGLG = $tg7;
        $data->TMPG = $tp7;
        $data->HSLG = ucfirst($hs7);
        $data->save();

        return redirect()->back()->with('addkli','.');
    }

    public function updpp(Request $request,$id)
    {
        $tg1 = $request->tg1;
        $tp1 = $request->tp1;
        $hs1 = $request->hs1; 
        $tg2 = $request->tg2;
        $tp2 = $request->tp2;
        $hs2 = $request->hs2; 
        $tg3 = $request->tg3;
        $tp3 = $request->tp3;
        $hs3 = $request->hs3; 
        $tg4 = $request->tg4;
        $tp4 = $request->tp4;
        $hs4 = $request->hs4;
        $tg5 = $request->tg5;
        $tp5 = $request->tp5;
        $hs5 = $request->hs5; 
        $tg6 = $request->tg6;
        $tp6 = $request->tp6;
        $hs6 = $request->hs6; 
        $jn7 = $request->jn7;
        $tg7 = $request->tg7;
        $tp7 = $request->tp7;
        $hs7 = $request->hs7;

            $data = DB::table('p_penunjang')->WHERE('PENJ_ID',$id)->update(['TGLA'=>$tg1,'TMPA'=>ucfirst($tp1),'HSLA'=>$hs1,'TGLB'=>$tg2,'TMPB'=>ucfirst($tp2),'HSLB'=>ucfirst($hs2),'TGLC'=>$tg3,'TMPC'=>ucfirst($tp3),'HSLC'=>ucfirst($hs3),'TGLD'=>$tg4,'TMPD'=>ucfirst($tp4),'HSLD'=>ucfirst($hs4),'TGLE'=>$tg5,'TMPE'=>ucfirst($tp5),'HSLE'=>$hs5,'TGLF'=>$tg6,'TMPF'=>ucfirst($tp6),'HSLF'=>$hs6,'JNG'=>ucfirst($jn7),'TGLG'=>$tg7,'TMPG'=>ucfirst($tp7),'HSLG'=>ucfirst($hs7)]);
        
        return redirect()->back()->with('addkli','.');
    }

    public function delpp($id)
    {
        DB::table('p_penunjang')->WHERE('PENJ_ID',$id)->delete();

        return redirect()->back()->with('addkli','.');
    }

    // public function dtarip($id)
    // {   
    //     if(Session::get('nama') == null){
    //         return redirect('/')->with('errlog','.');
    //     }else{
    //         $nid = $id;
    //         $idra = riper1::getId();
    //         $idrb = riper2::getId();
    //         $idrc = riper3::getId();
    //         $idrd = riper4::getId();
    //         $data = DB::SELECT("SELECT*FROM pasien a,r_perj1 b WHERE a.NIK = '$id' AND b.NIK = '$id' GROUP BY a.NIK");
    //         $pas = DB::SELECT("SELECT*FROM pasien WHERE NIK = '$id'");
    //         return view('/petugas/dt_riperjalanan',['nid'=>$nid,'data'=>$data,'idra'=>$idra,'idrb'=>$idrb,'idrc'=>$idrc,'idrd'=>$idrd,'pas'=>$pas]);

    //     }
    // }

    // public function addriper(Request $request)
    // {
    //     $ida = $request->idaa;
    //     $idb = $request->idab;
    //     $ni = $request->nik;
    //     $sa1 = $request->sta;
    //     $ne1 = $request->neg;
    //     $ko1 = $request->kot;
    //     $tp1 = $request->tgp;
    //     $tt1 = $request->tgt;
    //     $ne2 = $request->nega;
    //     $ko2 = $request->kota;
    //     $tp2 = $request->tgpa;
    //     $tt2 = $request->tgta;

    //     $idc = $request->idac;
    //     $idd = $request->idad;
    //     $sa2 = $request->sta2;
    //     $pr3 = $request->prob;
    //     $ko3 = $request->kotb;
    //     $tp3 = $request->tgpb;
    //     $tt3 = $request->tgtb;
    //     $pr4 = $request->proc;
    //     $ko4 = $request->kotc;
    //     $tp4 = $request->tgpc;
    //     $tt4 = $request->tgtc;

    //     $ide = $request->idae;
    //     $ni = $request->nik;
    //     $sa3 = $request->sta3;
    //     $pr5 = $request->prod;
    //     $ko5 = $request->kotd;

    //     $idf = $request->idaf;
    //     $idg = $request->idag;
    //     $sa4 = $request->sta4;
    //     $ni = $request->nik;
    //     $na = $request->nama;
    //     $ala = $request->alae;
    //     $ha = $request->huba;
    //     $ta = $request->tka;
    //     $tb = $request->tkb;
    //     $nb = $request->namb;
    //     $alb = $request->alaf;
    //     $hb = $request->hubb;
    //     $tc = $request->tkc;
    //     $td = $request->tkd;


     
    //     $data = new riper1();
    //     if($ida == null){
    //         $data->PERJ1_ID = 1;
    //     }else{
    //         $data->PERJ1_ID = $ida;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa1;
    //     $data->NEGARA = $ne1;
    //     $data->KOTA = $ko1;
    //     $data->TGL_PERJ = $tp1;
    //     $data->TGL_TIBA = $tt1;
    //     $data->save();

    //     if ($ne2 == null){

    //     }else{
            
    //     $data = new riper1();
    //     if($idb == null){
    //         $data->PERJ1_ID = 2;
    //     }else{
    //         $data->PERJ1_ID = $idb;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa1;
    //     $data->NEGARA = $ne2;
    //     $data->KOTA = $ko2;
    //     $data->TGL_PERJ = $tp2;
    //     $data->TGL_TIBA = $tt2;    
    //     $data->save();

    //     }

    //     $data = new riper2();
    //     if($idc == null){
    //         $data->PERJ2_ID = 1;
    //     }else{
    //         $data->PERJ2_ID = $idc;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa2;
    //     $data->PROV = $pr3;
    //     $data->KOTA = $ko3;
    //     $data->TGL_PERJ = $tp3;
    //     $data->TGL_TIBA = $tt3;
    //     $data->save();

    //     if ($pr4 == null){

    //     }else{
            
    //     $data = new riper2();
    //     if($idd == null){
    //         $data->PERJ2_ID = 2;
    //     }else{
    //         $data->PERJ2_ID = $idd;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa2;
    //     $data->PROV = $pr4;
    //     $data->KOTA = $ko4;
    //     $data->TGL_PERJ = $tp4;
    //     $data->TGL_TIBA = $tt4;    
    //     $data->save();

    //     }

    //     $data = new riper3();
    //     if($ide == null){
    //         $data->PERJ3_ID = 1;
    //     }else{
    //         $data->PERJ3_ID = $ide;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa3;
    //     $data->PROV = $pr5;
    //     $data->KOTA = $ko5;
    //     $data->save();

    //     $data = new riper4();
    //     if($idf == null){
    //         $data->PERJ4_ID = 1;
    //     }else{
    //         $data->PERJ4_ID = $idf;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa4;
    //     $data->NAMA = $na;
    //     $data->ALAMAT = $ala;
    //     $data->HUBUNGAN = $ha;
    //     $data->TGL_AWAL = $ta;
    //     $data->TGL_AKHIR = $tb;
    //     $data->save();

    //     if ($nb == null){

    //     }else{
            
    //     $data = new riper4();
    //     if($idg == null){
    //         $data->PERJ4_ID = 2;
    //     }else{
    //         $data->PERJ4_ID = $idg;
    //     }
    //     $data->NIK = $ni;
    //     $data->STATUS = $sa4;
    //     $data->NAMA = $nb;
    //     $data->ALAMAT = $alb;
    //     $data->HUBUNGAN = $hb;
    //     $data->TGL_AWAL = $tc;
    //     $data->TGL_AKHIR = $td;    
    //     $data->save();

    //     }

    //     return redirect()->back()->with('addkli','.');
    // }

    public function detriper($id)
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{
            $nid = $id;
            $idra = riper1::getId();
            $idrb = riper2::getId();
            $idrc = riper3::getId();
            $idrd = riper4::getId();
            $st1 = DB::SELECT("SELECT STATUS FROM r_perj1 WHERE NIK = '$id' GROUP BY STATUS");
            $st2 = DB::SELECT("SELECT STATUS FROM r_perj2 WHERE NIK = '$id' GROUP BY STATUS");
            $st3 = DB::SELECT("SELECT STATUS FROM r_perj3 WHERE NIK = '$id' GROUP BY STATUS");
            $st4 = DB::SELECT("SELECT STATUS FROM r_perj4 WHERE NIK = '$id' GROUP BY STATUS");
            $pas = DB::SELECT("SELECT*FROM pasien a, kelurahan b, kecamatan c, kota d WHERE a.KEL_ID = b.KEL_ID AND a.KEC_ID = c.KEC_ID AND a.KOTA_ID = d.KOTA_ID AND a.NIK = '$id'");
            $rpa = DB::SELECT("SELECT*FROM r_perj1 b WHERE NIK = '$id'");
            $rpb = DB::SELECT("SELECT*FROM r_perj2 b WHERE NIK = '$id'");
            $rpc = DB::SELECT("SELECT*FROM r_perj3 b WHERE NIK = '$id'");
            $rpd = DB::SELECT("SELECT*FROM r_perj4 b WHERE NIK = '$id'");

            return view('/petugas/det_riper',['nid'=> $nid,'idra'=>$idra,'idrb'=>$idrb,'idrc'=>$idrc,'idrd'=>$idrd,'pas'=>$pas,'st1'=>$st1,'st2'=>$st2,'st3'=>$st3,'st4'=>$st4,'rpa'=>$rpa,'rpb'=>$rpb,'rpc'=>$rpc,'rpd'=>$rpd]);

        }
    }

    public function delriper($id)
    {
        DB::table('r_perj1')->WHERE('NIK',$id)->delete();
        DB::table('r_perj2')->WHERE('NIK',$id)->delete();
        DB::table('r_perj3')->WHERE('NIK',$id)->delete();
        DB::table('r_perj4')->WHERE('NIK',$id)->delete();

        return redirect()->back()->with('addkli','.');
    }

    public function addripa(Request $request)
    {
        $ida = $request->idaa;
        $ni = $request->nik;
        $ne1 = $request->neg;
        $ko1 = $request->kot;
        $tp1 = $request->tgp;
        $tt1 = $request->tgt;

         $data = new riper1();
        if($ida == null){
            $data->PERJ1_ID = 1;
        }else{
            $data->PERJ1_ID = $ida;
        }
        $data->NIK = $ni;
        $data->STATUS = 'Ya';
        $data->NEGARA = $ne1;
        $data->KOTA = $ko1;
        $data->TGL_PERJ = $tp1;
        $data->TGL_TIBA = $tt1;
        $data->save();

        return redirect()->back()->with('addpas','.');
    }

    public function updripa(Request $request,$id)
    {
        $ne1 = $request->neg;
        $ko1 = $request->kot;
        $tp1 = $request->tgp;
        $tt1 = $request->tgt;
        $sta = 'Ya';

        $data = DB::table('r_perj1')->WHERE('PERJ1_ID',$id)->update(['NEGARA'=>ucfirst($ne1),'KOTA'=>ucfirst($ko1),'TGL_PERJ'=>$tp1,'TGL_TIBA'=>$tt1,'STATUS'=>$sta]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function delripa($id)
    {
        DB::table('r_perj1')->WHERE('PERJ1_ID',$id)->delete();

        return redirect()->back()->with('updpas','.');
    }

    public function addripb(Request $request)
    {
        $ida = $request->idaa;
        $ni = $request->nik;
        $pro = $request->pro;
        $ko1 = $request->kot;
        $tp1 = $request->tgp;
        $tt1 = $request->tgt;

         $data = new riper2();
        if($ida == null){
            $data->PERJ2_ID = 1;
        }else{
            $data->PERJ2_ID = $ida;
        }
        $data->NIK = $ni;
        $data->STATUS = 'Ya';
        $data->PROV = $pro;
        $data->KOTA = $ko1;
        $data->TGL_PERJ = $tp1;
        $data->TGL_TIBA = $tt1;
        $data->save();

        return redirect()->back()->with('addpas','.');
    }

    public function updripb(Request $request,$id)
    {
        $pro = $request->pro;
        $ko1 = $request->kot;
        $tp1 = $request->tgp;
        $tt1 = $request->tgt;
        $sta = 'Ya';

        $data = DB::table('r_perj2')->WHERE('PERJ2_ID',$id)->update(['PROV'=>ucfirst($pro),'KOTA'=>ucfirst($ko1),'TGL_PERJ'=>$tp1,'TGL_TIBA'=>$tt1,'STATUS'=>$sta]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function delripb($id)
    {
        DB::table('r_perj2')->WHERE('PERJ2_ID',$id)->delete();

        return redirect()->back()->with('updpas','.');
    }

    public function addripc(Request $request)
    {
        $ida = $request->idaa;
        $ni = $request->nik;
        $pro = $request->pro;
        $ko1 = $request->kot;

         $data = new riper3();
        if($ida == null){
            $data->PERJ3_ID = 1;
        }else{
            $data->PERJ3_ID = $ida;
        }
        $data->NIK = $ni;
        $data->STATUS = 'Ya';
        $data->PROV = $pro;
        $data->KOTA = $ko1;
        $data->save();

        return redirect()->back()->with('addpas','.');
    }

    public function updripc(Request $request,$id)
    {
        $pro = $request->pro;
        $ko1 = $request->kot;
        $sta = 'Ya';

        $data = DB::table('r_perj3')->WHERE('PERJ3_ID',$id)->update(['PROV'=>ucfirst($pro),'KOTA'=>ucfirst($ko1),'STATUS'=>$sta]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function delripc($id)
    {
        DB::table('r_perj3')->WHERE('PERJ3_ID',$id)->delete();

        return redirect()->back()->with('updpas','.');
    }

    public function addripd(Request $request)
    {
        $ida = $request->idaa;
        $ni = $request->nik;
        $na = $request->nam;
        $al = $request->ala;
        $hu = $request->hub;
        $tp = $request->tgp;
        $tt = $request->tgt;

         $data = new riper4();
        if($ida == null){
            $data->PERJ4_ID = 1;
        }else{
            $data->PERJ4_ID = $ida;
        }
        $data->NIK = $ni;
        $data->STATUS = 'Ya';
        $data->NAMA = $na;
        $data->ALAMAT = $al;
        $data->HUBUNGAN = $hu;
        $data->TGL_AWAL = $tp;
        $data->TGL_AKHIR = $tt;
        $data->save();

        return redirect()->back()->with('addpas','.');
    }

    public function updripd(Request $request,$id)
    {
        $nam = $request->nam;
        $ala = $request->ala;
        $hub = $request->hub;
        $tgp = $request->tgp;
        $tgt = $request->tgt;
        $sta = 'Ya';

        $data = DB::table('r_perj4')->WHERE('PERJ4_ID',$id)->update(['NAMA'=>ucfirst($nam),'ALAMAT'=>ucfirst($ala),'HUBUNGAN'=>ucfirst($hub),'TGL_AWAL'=>$tgp,'TGL_AKHIR'=>$tgt,'STATUS'=>$sta]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function delripd($id)
    {
        DB::table('r_perj4')->WHERE('PERJ4_ID',$id)->delete();

        return redirect()->back()->with('updpas','.');
    }

    public function dtappr($id)
    {   
        if(Session::get('nama') == null){
            return redirect('/')->with('errlog','.');
        }else{
            $nid = $id;
            $ipa = paparana::getId();
            $ipb = paparanb::getId();
            $pas = DB::SELECT("SELECT * FROM pasien WHERE NIK = '$id'");
            $data = DB::SELECT("SELECT *, a.NAMA as nam FROM pasien a, paparan1 b, paparan2 c WHERE a.NIK = '$id' AND b.NIK = '$id' AND a.NIK = '$id' GROUP BY a.NIK");
            $pa = DB::SELECT("SELECT*FROM paparan1 WHERE NIK = '$id'");
            $pb = DB::SELECT("SELECT*FROM paparan2 WHERE NIK = '$id'");
            if($data == null){
                return view('/petugas/add_paparan',['nid'=>$nid,'ipa'=>$ipa,'ipb'=>$ipb,'pas'=>$pas]);
            }else{
                return view('/petugas/det_paparan',['nid'=>$nid,'ipa'=>$ipa,'ipb'=>$ipb,'data'=>$data,'pas'=>$pas,'pa'=>$pa,'pb'=>$pb]);
            }

        }
    }


    public function addppr(Request $request)
    {
        $ni = $request->nik;

        $ia = $request->iaa;
        $st = $request->sta;
        $na = $request->nam;
        $al = $request->ala;
        $hu = $request->hub;
        $tp = $request->tgp;
        $tt = $request->tgt;

        $ib = $request->iab;
        $na2 = $request->nam2;
        $al2 = $request->ala2;
        $hu2 = $request->hub2;
        $tp2 = $request->tgp2;
        $tt2 = $request->tgt2;


        $iba = $request->iba;
        $isp = $request->ispa;
        $she = $request->shew;
        $anj = $request->anj;
        $kuc = $request->kuc;
        $hla = $request->hla;
        $sap = $request->apd;
        $apa = $request->apd1;
        $apb = $request->apd2;
        $apc = $request->apd3;
        $apd = $request->apd4;
        $ape = $request->apd5;
        $apf = $request->apd6;
        $tap = $request->apd7;
        $pro = $request->pro;
        $lai = $request->lain;




        $data = new paparana();

        if($ia == null){
            $data->PA1_ID = 1;
        }else{
            $data->PA1_ID = $ia;
        }
        $data->NIK = $ni;
        $data->STATUS = $st;
        $data->NAMA = $na;
        $data->ALAMAT = $al;
        $data->HUBUNGAN = $hu;
        $data->TGL_AWAL = $tp;
        $data->TGL_AKHIR = $tt;
        $data->save(); 

        if($na2 == null){

        }else{
            $data = new paparana();

            if($ib == null){
                $data->PA1_ID = 2;
            }else{
                $data->PA1_ID = $ib;
            }
            $data->NIK = $ni;
            $data->STATUS = $st;
            $data->NAMA = $na2;
            $data->ALAMAT = $al2;
            $data->HUBUNGAN = $hu2;
            $data->TGL_AWAL = $tp2;
            $data->TGL_AKHIR = $tt2;
            $data->save();
        }

        $data = new paparanb();

        if($ib == null){
            $data->PA2_ID = 1;
        }else{
            $data->PA2_ID = $iba;
        }
        $data->NIK = $ni;
        $data->ISPA = $isp;
        if($she == 'Ya'){
            $data->ST_HEWAN = $she;
            $data->ANJING = $anj;
            $data->KUCING = $kuc;
            $data->S_HEWAN = $hla;
        }else{
            $data->ST_HEWAN = 'Tidak';
            $data->ANJING = 'Tidak';
            $data->KUCING = 'Tidak';
            $data->S_HEWAN = 'Tidak';
        }
        $data->PET_KES = $sap;
        if($sap == 'Ya'){
            if ($tap == null){
                $data->APD1 = $apa;
                $data->APD2 = $apb;
                $data->APD3 = $apc;
                $data->APD4 = $apd;
                $data->APD5 = $ape;
                $data->APD6 = $apf;
                $data->TAPD = 'Tidak';
            }else{
                $data->APD1 = 'Tidak';
                $data->APD2 = 'Tidak';
                $data->APD3 = 'Tidak';
                $data->APD4 = 'Tidak';
                $data->APD5 = 'Tidak';
                $data->APD6 = 'Tidak';
                $data->TAPD = 'Ya';
            }
        }else{
            $data->APD1 = 'Tidak';
            $data->APD2 = 'Tidak';
            $data->APD3 = 'Tidak';
            $data->APD4 = 'Tidak';
            $data->APD5 = 'Tidak';
            $data->APD6 = 'Tidak';
            $data->TAPD = 'Tidak';
        }
       
        $data->PROSEDUR = $pro;
        $data->LAINNYA = $lai;
        $data->save();

        return redirect('pasien:fp='.$ni);
    }

    public function updppr(Request $request,$id)
    {
        $isp = $request->ispa;
        $she = $request->shew;
        
        $sap = $request->apd;
        $tap = $request->apd7;
        
        $pro = $request->pro;
        $lai = $request->lain;

        if ($she == 'Ya'){
            $anj = $request->anj;
            $kuc = $request->kuc;
            $hla = $request->hla;
        }else{
            $anj = null;
            $kuc = null;
            $hla = null;
        }

        if($sap == 'Ya'){
            if($tap == 'Ya'){
                $apa = null;
                $apb = null;
                $apc = null;
                $apd = null;
                $ape = null;
                $apf = null;
            }else{
                $apa = $request->apd1;
                $apb = $request->apd2;
                $apc = $request->apd3;
                $apd = $request->apd4;
                $ape = $request->apd5;
                $apf = $request->apd6;
            }
        }else{
            $apa = 'Tidak';
            $apb = 'Tidak';
            $apc = 'Tidak';
            $apd = 'Tidak';
            $ape = 'Tidak';
            $apf = 'Tidak';
            $tap = 'Tidak';
        }

        $data = DB::table('paparan2')->WHERE('PA2_ID',$id)->update(['ISPA'=>$isp,'ST_HEWAN'=>$she,'ANJING'=>$anj,'KUCING'=>$kuc,'S_HEWAN'=>$hla,'PET_KES'=>$sap,'APD1'=>$apa,'APD2'=>$apb,'APD3'=>$apc,'APD4'=>$apd,'APD5'=>$ape,'APD6'=>$apf,'TAPD'=>$tap,'PROSEDUR'=>$pro,'LAINNYA'=>$lai]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function delppr($id)
    {
        DB::table('paparan1')->WHERE('NIK',$id)->delete();
        DB::table('paparan2')->WHERE('NIK',$id)->delete();

        return redirect('datapaparan')->with('delpas','.');
    }

    // public function detppr($id)
    // {   
    //     if(Session::get('nama') == null){
    //         return redirect('/')->with('errlog','.');
    //     }else{

    //         $ipa = paparana::getId();
    //         $spa = DB::SELECT("SELECT*FROM paparan1 WHERE NIK = '$id' GROUP BY STATUS ");
    //         $pa = DB::SELECT("SELECT*FROM paparan1 WHERE NIK = '$id'");
    //         $da = DB::SELECT("SELECT*FROM paparan1");
    //         $pb = DB::SELECT("SELECT*FROM paparan2 WHERE NIK = '$id'");

    //         return view('/petugas/det_paparan',['spa'=>$spa,'pa'=>$pa,'pb'=>$pb,'ipa'=>$ipa,'da'=>$da]);

    //     }
    // }

    public function adddppr(Request $request)
    {
       
        $ipa = $request->ipa;
        $ni = $request->nik;
        $na = $request->nam;
        $al = $request->ala;
        $hu = $request->hub;
        $tp = $request->tgp;
        $tt = $request->tgt;

         $data = new paparana();
        if($ipa == null){
            $data->PA1_ID = 1;
        }else{
            $data->PA1_ID = $ipa;
        }
        $data->NIK = $ni;
        $data->STATUS = 'Ya';
        $data->NAMA = $na;
        $data->ALAMAT = $al;
        $data->HUBUNGAN = $hu;
        $data->TGL_AWAL = $tp;
        $data->TGL_AKHIR = $tt;
        $data->save();

        return redirect()->back()->with('addpas','.');
    }

    public function upddppr(Request $request,$id)
    {
        $nam = $request->nam;
        $ala = $request->ala;
        $hub = $request->hub;
        $tgp = $request->tgp;
        $tgt = $request->tgt;

        $data = DB::table('paparan1')->WHERE('PA1_ID',$id)->update(['NAMA'=>ucfirst($nam),'ALAMAT'=>ucfirst($ala),'HUBUNGAN'=>ucfirst($hub),'TGL_AWAL'=>$tgp,'TGL_AKHIR'=>$tgt]);
        
        return redirect()->back()->with('updpas','.');
    }

    public function deldppr($id)
    {
        DB::table('paparan1')->WHERE('PA1_ID',$id)->delete();

        return redirect()->back()->with('delpas','.');
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


                $ka2f= DB::SELECT("SELECT COUNT(*) as jum, a.NIK FROM pasien a, klinis WHERE a.NIK = klinis.NIK AND NOT EXISTS (SELECT * FROM kontak b WHERE b.NIK = a.NIK) AND NOT EXISTS(SELECT*FROM r_perj1 c ,r_perj2 d ,r_perj3 e , r_perj4 f WHERE c.NIK = a.NIK AND d.NIK = a.NIK AND e.NIK = a.NIK AND f.NIK = a.NIK) AND klinis.TGL_RELEASE = '$tga'");
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

                $ka2f= DB::SELECT("SELECT COUNT(*) as jum, a.NIK FROM pasien a, klinis WHERE a.NIK = klinis.NIK AND NOT EXISTS (SELECT * FROM kontak b WHERE b.NIK = a.NIK) AND NOT EXISTS(SELECT*FROM r_perj1 c ,r_perj2 d ,r_perj3 e , r_perj4 f WHERE c.NIK = a.NIK AND d.NIK = a.NIK AND e.NIK = a.NIK AND f.NIK = a.NIK) AND klinis.TGL_RELEASE BETWEEN '$tga' AND '$tgb'");
                $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");


                $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");



                $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");



                $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND b.TGL_RELEASE BETWEEN '$tga' AND '$tgb' ");

            }


            return view('/petugas/lp_perhari',[
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

                'ka2f'=>$ka2f,
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

                $ka2f= DB::SELECT("SELECT COUNT(*) as jum, a.NIK FROM pasien a, klinis WHERE a.NIK = klinis.NIK AND NOT EXISTS (SELECT * FROM kontak b WHERE b.NIK = a.NIK) AND NOT EXISTS(SELECT*FROM r_perj1 c ,r_perj2 d ,r_perj3 e , r_perj4 f WHERE c.NIK = a.NIK AND d.NIK = a.NIK AND e.NIK = a.NIK AND f.NIK = a.NIK) AND MONTH(klinis.TGL_RELEASE) = '$cbbln' AND YEAR(klinis.TGL_RELEASE) = '$cbthn' ");
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

                $ka2f= DB::SELECT("SELECT COUNT(*) as jum, a.NIK FROM pasien a, klinis WHERE a.NIK = klinis.NIK AND NOT EXISTS (SELECT * FROM kontak b WHERE b.NIK = a.NIK) AND NOT EXISTS(SELECT*FROM r_perj1 c ,r_perj2 d ,r_perj3 e , r_perj4 f WHERE c.NIK = a.NIK AND d.NIK = a.NIK AND e.NIK = a.NIK AND f.NIK = a.NIK) AND MONTH(klinis.TGL_RELEASE) = '$cbbln' AND YEAR(klinis.TGL_RELEASE) = '$cbthn' ");
                $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");



                $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");


                $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");



                $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND MONTH(b.TGL_RELEASE) = '$cbbln' AND YEAR(b.TGL_RELEASE) = '$cbthn' ");

            }
            
            

            return view('/petugas/lp_perbulan',[
                
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

                'ka2f'=>$ka2f,
                'ka2g'=>$ka2g,

                'ka3f'=>$ka3f,
                

                'ka4b'=>$ka4b,

                'ka5a'=>$ka5a,
            ]);

        }
    }

    public function ctklaphari(Request $request)
    {
        
        $ta = $request->tgla;
        $tb = $request->tglb;

        return Excel::download(new LapHariExport($ta,$tb), 'Laporan per Hari.xlsx');

    }
    public function ctklapbulan(Request $request)
    {
        
        $bln = $request->bulan;
        $thn = $request->tahun;

        return Excel::download(new LapBulanExport($bln,$thn), 'Laporan per Bulan.xlsx');

    }


}
