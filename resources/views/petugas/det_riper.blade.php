@extends('layout.laypetugas')

@section('menu')
  <ul class="sidebar-menu">
    <li class="menu-header" style="text-align: center;">Nama Pasien</li>
        <li class="dropdown" style="text-align: center;text-transform: uppercase;font-weight: bold;">
          <a href="#" class="nav-link"><!-- <i data-feather="user-check"></i> --><span> @foreach($pas as $nama) {{$nama->NAMA}} @endforeach </span></a>
        </li>
    <li class="menu-header">Data</li>
        <li class="dropdown">
          <a href="/pasien:kl={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Informasi Klinis</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:pp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Pemeriksaan Penunjang</span></a>
        </li>
        <li class="dropdown active">
          <a href="#" class="nav-link"><i data-feather="check-circle"></i><span>Riwayat Perjalanan</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:fp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Faktor Kontak / Paparan</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:ke={{$nid}}" class="nav-link"><i data-feather="users"></i><span>Kontak Erat</span></a>
        </li>
  </ul>
@endsection
<?php 
    $no = 1;
    $sta = array('Ya','Tidak','Tidak Tahu');
  ?>

@section('content')
  <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Riwayat Perjalanan</h4>
            </div>
            <div class="card-body table-border-style">
                <div class="row">            
                    <!-- <div class="col-md-12" style="margin: -20px 0px 30px 0px;">
                        <center><label><b>Data Diri</b></label></center>
                        <style type="text/css">
                           .jarak{
                            padding-right: 20px;
                          }
                        </style>
                        @foreach($pas as $det)
                        <table>
                           <tr>
                               <td>Nama</td>
                               <td>:</td>
                               <td>{{$det->NAMA}}</td>
                               <td class="jarak"></td>
                               <td>Tgl Lahir</td>
                               <td>:</td>
                               <td><?php echo date('d M Y',strtotime($det->TGL_LAHIR)); ?></td>
                               <td class="jarak"></td>
                               <td>Umur</td>
                               <td>:</td>
                               <td>{{$det->UMUR}} tahun</td>
                               <td class="jarak"></td>
                               <td>Gender</td>
                               <td>:</td>
                               <td>{{$det->GENDER}}</td>
                           </tr>
                           <tr>
                               <td>Pekerjaan</td>
                               <td>:</td>
                               <td>{{$det->PEKERJAAN}}</td>
                               <td class="jarak"></td>
                               <td>Alamat</td>
                               <td>:</td>
                               <td>{{$det->ALAMAT}} Rt.{{$det->RT}}/Rw.{{$det->RW}}</td>
                               <td class="jarak"></td>
                               <td>Desa</td>
                               <td>:</td>
                               <td>Desa {{$det->KELURAHAN}}</td>
                               <td class="jarak"></td>
                               <td>Kecamatan</td>
                               <td>:</td>
                               <td>{{$det->NAMA_KEC}}</td>
                           </tr>
                           <tr>
                               <td>Kab / Kota</td>
                               <td>:</td>
                               <td>{{$det->NAMA_KOTA}}</td>
                               <td class="jarak"></td>
                               <td>No Ponsel</td>
                               <td>:</td>
                               <td>{{$det->NO_TELP}}</td>
                               <td class="jarak"></td>
                               <td>Kategori</td>
                               <td>:</td>
                               <td>{{$det->KAT}}</td>
                           </tr>
                       </table>
                        @endforeach
                    <br>
                    <a href="/datariper" class="btn btn-success btn-block"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
                    </div>-->
                    <div class="col-md-12">
                        <a href="/datapasien" class="btn btn-light"><i class="fa fa-search"></i> Pilih Pasien</a>
                    </div>
                    <hr>
                    <style type="text/css">
                        table tr td{
                            padding: 5px;
                        }
                    </style>
                    <div class="col-md-12">
                        <table border="" style="width: 100%;margin-top: 10px;">
                            <tr>
                                <td colspan="5">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambaha"><i class="fas fa-plus-square"></i> Tambah Data</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width: 85%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki riwayat perjalanan dari luar negeri ?</td>
                                <td colspan="1" style="width: 15%;padding: 5px;"> 
                                  @foreach($st1 as $s1) {{$s1->STATUS}} @endforeach
                                </td>
                            </tr>
                            <tr style="text-align: center;background-color: lightgrey">
                                <td style="width: 120px;">Negara</td>
                                <td style="width: 120px;">Kota</td>
                                <td style="width: 50px;">Tgl Perjalanan</td>
                                <td style="width: 50px;">Tgl Tiba</td>
                                <td>Aksi</td>
                            </tr>
                            @foreach($rpa as $d1)
                            <tr style="text-align: center;">
                                <td>{{$d1->NEGARA}}</td>
                                <td>{{$d1->KOTA}}</td>
                                <td>@if($d1->TGL_PERJ == null) @else <?php echo date('d M Y',strtotime($d1->TGL_PERJ)); ?> @endif</td>
                                <td>@if($d1->TGL_TIBA == null) @else <?php echo date('d M Y',strtotime($d1->TGL_TIBA)); ?> @endif</td>
                                <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editRipera{{$d1->PERJ1_ID}}"><i class="fa fa-edit"></i></a>
                                <a href="/ripa:del={{$d1->PERJ1_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>


                        <table border="" style="width: 100%;margin-top: 20px;">
                            <tr>
                                <td colspan="5">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahb"><i class="fas fa-plus-square"></i> Tambah Data</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width: 85%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki riwayat perjalanan dari area transmisi lokal ?</td>
                                <td colspan="1" style="width: 15%;padding: 5px;"> 
                                  @foreach($st2 as $s2) {{$s2->STATUS}} @endforeach
                                </td>
                            </tr>
                            <tr style="text-align: center;background-color: lightgrey">
                                <td style="width: 120px;">Provinsi</td>
                                <td style="width: 120px;">Kota</td>
                                <td style="width: 50px;">Tgl Perjalanan</td>
                                <td style="width: 50px;">Tgl Tiba</td>
                                <td>Aksi</td>
                            </tr>
                            @foreach($rpb as $d2)
                            <tr style="text-align: center;">
                                <td>{{$d2->PROV}}</td>
                                <td>{{$d2->KOTA}}</td>
                                <td>
                                  <?php 
                                    if($d2->TGL_PERJ == null){

                                    }else{ 
                                       echo date('d M Y',strtotime($d2->TGL_PERJ));
                                    } 
                                  ?>
                                  </td>
                                <td><?php 
                                    if($d2->TGL_TIBA == null){

                                    }else{ 
                                       echo date('d M Y',strtotime($d2->TGL_TIBA));
                                    } 
                                  ?></td>
                                <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editRiperb{{$d2->PERJ2_ID}}"><i class="fa fa-edit"></i></a>
                                <a href="/ripb:del={{$d2->PERJ2_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>

                        <table border="" style="width: 100%;margin-top: 20px;">
                            <tr>
                                <td colspan="5">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahc"><i class="fas fa-plus-square"></i> Tambah Data</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 85%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki riwayat perjalanan ke area transmisi lokal ?</td>
                                <td style="width: 15%;padding: 5px;"> 
                                  @foreach($st3 as $s3) {{$s3->STATUS}} @endforeach
                                </td>
                            </tr>
                            <tr style="text-align: center;background-color: lightgrey">
                                <td>Provinsi</td>
                                <td>Kota</td>
                                <td>Aksi</td>
                            </tr>
                            @foreach($rpc as $d3)
                            <tr style="text-align: center;">
                                <td>{{$d3->PROV}}</td>
                                <td>{{$d3->KOTA}}</td>
                                <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editRiperc{{$d3->PERJ3_ID}}"><i class="fa fa-edit"></i></a>
                                <a href="/ripc:del={{$d3->PERJ3_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>

                        <table border="" style="width: 100%;margin-top: 20px;">
                            <tr>
                                <td colspan="5">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahd"><i class="fas fa-plus-square"></i> Tambah Data</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width: 85%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki kontak dengan kasus suspek/ probable COVID-19</td>
                                <td colspan="1" style="width: 15%;padding: 5px;"> 
                                  @foreach($st4 as $s4) {{$s4->STATUS}} @endforeach
                                </td>
                            </tr>
                            <tr style="text-align: center;background-color: lightgrey">
                                <td style="width: 140px;">Nama</td>
                                <td style="width: 130px;">Alamat</td>
                                <td style="width: 110px;">Hubungan</td>
                                <!-- <td style="width: 50px;">Tgl Kontak </td> -->
                                <td>Tgl Kontak</td>
                                <td>Aksi</td>
                            </tr>
                            @foreach($rpd as $d4)
                            <tr style="text-align: center;">
                                <td>{{$d4->NAMA}}</td>
                                <td>{{$d4->ALAMAT}}</td>
                                <td>{{$d4->HUBUNGAN}}</td>
                                <td>
                                  <?php 
                                    if($d4->TGL_AWAL == null){

                                    }else{  
                                        echo date('d M Y',strtotime($d4->TGL_AWAL)); ?> s/d <?php echo date('d M Y',strtotime($d4->TGL_AKHIR)); 
                                    }
                                  ?>
                                  </td>
                                <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editRiperd{{$d4->PERJ4_ID}}"><i class="fa fa-edit"></i></a>
                                <a href="/ripd:del={{$d4->PERJ4_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <div class="modal fade" id="tambaha" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Riwayat Perjalanan A</h5>
        </div>

        <form action="{{url('/add_ripera')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-body">

              @foreach($idra as $ida)
                  <input class="form-control" type="hidden" name="idaa" value="{{$ida->PERJ1_ID+1}}" required="">
              @endforeach
                  <input class="form-control" type="hidden" name="nik" value="{{$nid}}" required="">

              <div class="form-group">
                  <label>Negara</label>
                  <input type="text" name="neg" class="form-control" placeholder="Kanada" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Kota</label>
                  <input type="text" name="kot" class="form-control" placeholder="Kediri" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Tanggal Perjalanan</label>
                  <input type="date" name="tgp" class="form-control" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Tanggal Tiba di Indonesia</label>
                  <input type="date" name="tgt" class="form-control" autocomplete="off" required="">
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
              <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  @foreach($rpa as $ed)
  <div class="modal fade" id="editRipera{{$ed->PERJ1_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Riwayat Perjalanan A</h5>
        </div>

        <?php 
            $id = $ed->PERJ1_ID;
            $upd = DB::SELECT("select*from r_perj1 where PERJ1_ID = '$id'");
        ?>
        @foreach($upd as $da)
        <form action="/ripa:upd={{$da->PERJ1_ID}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <div class="modal-body">
            <div class="form-group">
                <label>Negara</label>
                <input type="text" name="neg" class="form-control" value="{{$da->NEGARA}}" autocomplete="off" required="">
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" name="kot" class="form-control" value="{{$da->KOTA}}" autocomplete="off" required="">
            </div>
            <div class="form-group">
                <label>Tanggal Perjalanan</label>
                <input type="date" name="tgp" class="form-control" value="{{$da->TGL_PERJ}}" autocomplete="off" required="">
            </div>
            <div class="form-group">
                <label>Tanggal Tiba di Indonesia</label>
                <input type="date" name="tgt" class="form-control" value="{{$da->TGL_TIBA}}" autocomplete="off" required="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
            <button class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</button>
        </div>
        </form>
        @endforeach

      </div>
    </div>
  </div>
  @endforeach


  <div class="modal fade" id="tambahb" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Riwayat Perjalanan B</h5>
        </div>

        <form action="{{url('/add_riperb')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-body">

              @foreach($idrb as $idb)
                  <input class="form-control" type="hidden" name="idaa" value="{{$idb->PERJ2_ID+1}}" required="">
              @endforeach
                  <input class="form-control" type="hidden" name="nik" value="{{$nid}}" required="">

              <div class="form-group">
                  <label>Provinsi</label>
                  <input type="text" name="pro" class="form-control" placeholder="Jawa Timur" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Kota</label>
                  <input type="text" name="kot" class="form-control" placeholder="Kediri" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Tanggal Perjalanan</label>
                  <input type="date" name="tgp" class="form-control" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Tanggal Tiba di Indonesia</label>
                  <input type="date" name="tgt" class="form-control" autocomplete="off" required="">
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
              <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
          </div>
          </form>

      </div>
    </div>
  </div>

  @foreach($rpb as $ed)
  <div class="modal fade" id="editRiperb{{$ed->PERJ2_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Riwayat Perjalanan B</h5>
        </div>

        <?php 
            $id = $ed->PERJ2_ID;
            $upd = DB::SELECT("select*from r_perj2 where PERJ2_ID = '$id'");
        ?>
        @foreach($upd as $db)
        <form action="/ripb:upd={{$db->PERJ2_ID}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">
                <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" name="pro" class="form-control" value="{{$db->PROV}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kot" class="form-control" value="{{$db->KOTA}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Perjalanan</label>
                    <input type="date" name="tgp" class="form-control" value="{{$db->TGL_PERJ}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Tiba di Indonesia</label>
                    <input type="date" name="tgt" class="form-control" value="{{$db->TGL_TIBA}}" autocomplete="off" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                <button class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</button>
            </div>
        </form>
        @endforeach

      </div>
    </div>
  </div>
  @endforeach


  <div class="modal fade" id="tambahc" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Riwayat Perjalanan C</h5>
        </div>

        <form action="{{url('/add_riperc')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">

                @foreach($idrc as $idc)
                    <input class="form-control" type="hidden" name="idaa" value="{{$idc->PERJ3_ID+1}}" required="">
                @endforeach
                    <input class="form-control" type="hidden" name="nik" value="{{$nid}}" required="">
                <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" name="pro" class="form-control" placeholder="Jawa Timur" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kot" class="form-control" placeholder="Kediri" autocomplete="off" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
            </div>
        </form>

      </div>
    </div>
  </div>


  @foreach($rpc as $ed)
  <div class="modal fade" id="editRiperc{{$ed->PERJ3_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Riwayat Perjalanan C</h5>
        </div>

        <?php 

            $id = $ed->PERJ3_ID;
            $upd = DB::SELECT("select*from r_perj3 where PERJ3_ID = '$id'");

        ?>
        @foreach($upd as $dc)
        <form action="/ripc:upd={{$dc->PERJ3_ID}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">
                <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" name="pro" class="form-control" value="{{$dc->PROV}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kot" class="form-control" value="{{$dc->KOTA}}" autocomplete="off" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                <button class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</button>
            </div>
        </form>
        @endforeach

      </div>
    </div>
  </div>
  @endforeach


  <div class="modal fade" id="tambahd" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Riwayat Perjalanan D</h5>
        </div>

        <form action="{{url('/add_riperd')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">
                @foreach($idrd as $idd)
                    <input class="form-control" type="hidden" name="idaa" value="{{$idd->PERJ4_ID+1}}" required="">
                @endforeach
                    <input class="form-control" type="hidden" name="nik" value="{{$nid}}" required="">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nam" class="form-control" placeholder="Ahmad" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="ala" class="form-control" placeholder="Jl. Mawar " autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Hubungan</label>
                    <input type="text" name="hub" class="form-control" placeholder="Teman Kerja" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Perjalanan</label>
                    <input type="date" name="tgp" class="form-control" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Tiba di Indonesia</label>
                    <input type="date" name="tgt" class="form-control" autocomplete="off" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
            </div>
        </form>

      </div>
    </div>
  </div>


  @foreach($rpd as $ed)
  <div class="modal fade" id="editRiperd{{$ed->PERJ4_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Riwayat Perjalanan D</h5>
        </div>

        <?php 
            $id = $ed->PERJ4_ID;
            $upd = DB::SELECT("select*from r_perj4 where PERJ4_ID = '$id'");
        ?>
        @foreach($upd as $dd)
        <form action="/ripd:upd={{$dd->PERJ4_ID}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nam" class="form-control" value="{{$dd->NAMA}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="ala" class="form-control" value="{{$dd->ALAMAT}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Hubungan</label>
                    <input type="text" name="hub" class="form-control" value="{{$dd->HUBUNGAN}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Kontak Pertama</label>
                    <input type="date" name="tgp" class="form-control" value="{{$ed->TGL_AWAL}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Kontak Terakhir</label>
                    <input type="date" name="tgt" class="form-control" value="{{$dd->TGL_AKHIR}}" autocomplete="off" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                <button class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</button>
            </div>
        </form>
        @endforeach

      </div>
    </div>
  </div>
  @endforeach

@endsection