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
            <div class="card-body">
                <div class="row">
                  <div class="col-md-6" style="margin-bottom: 20px;">
                      <a href="/datapasien" class="btn btn-light"><i class="fa fa-search"></i> Pilih Pasien</a>  
                  </div>
                  <div class="col-md-6" align="right">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus-square"> </i> Tambah Data Riwayat Perjalanan</button>
                  </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="save-stage" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>Gender</th>
                          <th>Pekerjaan</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $dat)
                      <tr>
                          <td>{{$dat->NIK}}</td>
                          <td>{{$dat->NAMA}}</td>
                          <td>{{$dat->GENDER}}</td>
                          <td>{{$dat->PEKERJAAN}}</td>
                          <td style="width: 150px;">
                              <!-- <a href="/peserta:data={{$dat->NIK}}" class="btn btn-info"><i class="feather icon-info"></i></a>  -->
                              <a href="/riper:det={{$dat->NIK}}" class="btn btn-info"><i class="fa fa-info-circle"></i></a>
                              <a href="/riper:del={{$dat->NIK}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>


  <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pemeriksaan Penunjang</h5>
        </div>
        <form action="{{url('/add_riper')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="modal-body">
            <div class="col-md-12">
                <div class="row">
                    <input type="hidden" name="nik" value="{{$nid}}" readonly="">
                    @foreach($idra as $ida)
                        <input class="form-control" type="hidden" name="idaa" value="{{$ida->PERJ1_ID+1}}" required="">
                        <input class="form-control" type="hidden" name="idab" value="{{$ida->PERJ1_ID+2}}" required="">  
                    @endforeach
                    <table border="" style="width: 100%;margin-top: 10px;">
                        <tr>
                            <td colspan="3" style="width: 75%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki riwayat perjalanan dari luar negeri ?</td>
                            <td colspan="1" style="width: 25%;padding: 5px;"> 
                              <select name="sta" id="sta1" class="form-control" required="">
                                <option></option>
                                @foreach($sta as $st)
                                <option>{{$st}}</option>
                                @endforeach
                              </select>
                            </td>
                        </tr>
                        <tr style="text-align: center;background-color: lightgrey">
                            <td>Negara</td>
                            <td>Kota</td>
                            <td>Tgl Perjalanan</td>
                            <td>Tgl Tiba</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="neg" placeholder="Indonesia"></td>
                            <td><input class="form-control" type="text" name="kot" placeholder="Jakarta"></td>
                            <td><input class="form-control" type="date" name="tgp"></td>
                            <td><input class="form-control" type="date" name="tgt"></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="nega" placeholder="Indonesia"></td>
                            <td><input class="form-control" type="text" name="kota" placeholder="Jakarta"></td>
                            <td><input class="form-control" type="date" name="tgpa"></td>
                            <td><input class="form-control" type="date" name="tgta"></td>
                        </tr>
                    </table>
                      @foreach($idrb as $idb)
                          <input class="form-control" type="hidden" name="idac" value="{{$idb->PERJ2_ID+1}}" required="">
                          <input class="form-control" type="hidden" name="idad" value="{{$idb->PERJ2_ID+2}}" required="">  
                      @endforeach
                    <table border="" style="width: 100%;margin-top: 20px;">
                        <tr>
                            <td colspan="3" style="width: 75%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki riwayat perjalanan dari area transmisi lokal ?</td>
                            <td colspan="1" style="width: 25%;padding: 5px;"> 
                                <select name="sta2" id="sta1" class="form-control" required="">
                                    <option></option>
                                    @foreach($sta as $st)
                                    <option>{{$st}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr style="text-align: center;background-color: lightgrey">
                            <td>Provinsi</td>
                            <td>Kota</td>
                            <td>Tgl Perjalanan</td>
                            <td>Tgl Tiba</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="prob" placeholder="Jawa Timur"></td>
                            <td><input class="form-control" type="text" name="kotb" placeholder="Jakarta"></td>
                            <td><input class="form-control" type="date" name="tgpb"></td>
                            <td><input class="form-control" type="date" name="tgtb"></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="proc" placeholder="Jawa Timur"></td>
                            <td><input class="form-control" type="text" name="kotc" placeholder="Jakarta"></td>
                            <td><input class="form-control" type="date" name="tgpc"></td>
                            <td><input class="form-control" type="date" name="tgtc"></td>
                        </tr>
                    </table>
                        @foreach($idrc as $idc)
                            <input class="form-control" type="hidden" name="idae" value="{{$idc->PERJ3_ID+1}}" required=""> 
                        @endforeach
                    <table border="" style="width: 100%;margin-top: 20px;">
                        <tr>
                            <td style="width: 50%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki riwayat perjalanan ke area transmisi lokal ?</td>
                            <td colspan="1" style="width: 50%;padding: 5px;"> 
                                <select name="sta3" id="sta1" class="form-control" required="">
                                    <option></option>
                                    @foreach($sta as $st)
                                    <option>{{$st}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr style="text-align: center;background-color: lightgrey">
                            <td>Provinsi</td>
                            <td>Kota</td>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="prod" placeholder="Jawa Timur"></td>
                            <td><input class="form-control" type="text" name="kotd" placeholder="Jakarta"></td>
                        </tr>
                    </table>
                        @foreach($idrb as $idb)
                            <input class="form-control" type="hidden" name="idaf" value="{{$idb->PERJ2_ID+1}}" required="">
                            <input class="form-control" type="hidden" name="idag" value="{{$idb->PERJ2_ID+2}}" required="">  
                        @endforeach
                    <table border="" style="width: 100%;margin-top: 20px;">
                        <tr>
                            <td colspan="4" style="width: 80%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki kontak dengan kasus suspek / problable COVID-19 ?</td>
                            <td colspan="1" style="width: 20%;padding: 5px;"> 
                                <select name="sta4" id="sta1" class="form-control" required="" style="width: 150px;" >
                                    <option></option>
                                    @foreach($sta as $st)
                                    <option>{{$st}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr style="text-align: center;background-color: lightgrey">
                            <td>Nama</td>
                            <td>Alamat</td>
                            <td>Hubungan</td>
                            <td>Tgl Kontak Pertama</td>
                            <td>Tgl Kontak Terakhir</td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="nama" placeholder="Ahmad"></td>
                            <td><input class="form-control" type="text" name="alae" placeholder="Jl. Mawar" style="width: 160px;"></td>
                            <td><input class="form-control" type="text" name="huba" placeholder="Teman"></td>
                            <td><input class="form-control" type="date" name="tka" style="width: 160px;"></td>
                            <td><input class="form-control" type="date" name="tkb" style="width: 160px;"></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td><input class="form-control" type="text" name="namb" placeholder="Ahmad"></td>
                            <td><input class="form-control" type="text" name="alaf" placeholder="Jl. Mawar" style="width: 160px;"></td>
                            <td><input class="form-control" type="text" name="hubb" placeholder="Teman"></td>
                            <td><input class="form-control" type="date" name="tkc" style="width: 160px;"></td>
                            <td><input class="form-control" type="date" name="tkd" style="width: 160px;"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button  class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
            <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection