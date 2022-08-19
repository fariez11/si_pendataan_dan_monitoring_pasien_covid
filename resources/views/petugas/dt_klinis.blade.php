@extends('layout.laypetugas')

@section('menu')
  <ul class="sidebar-menu">
    <li class="menu-header" style="text-align: center;">Nama Pasien</li>
        <li class="dropdown" style="text-align: center;text-transform: uppercase;font-weight: bold;">
          <a href="#" class="nav-link"><!-- <i data-feather="user-check"></i> --><span> @foreach($pas as $nama) {{$nama->NAMA}} @endforeach </span></a>
        </li>
    <li class="menu-header">Data</li>
        <!-- <li class="dropdown">
          <a href="/datapasien" class="nav-link"><i data-feather="users"></i><span>Data Pasien</span></a>
        </li> -->
        <li class="dropdown active">
          <a href="#" class="nav-link"><i data-feather="check-circle"></i><span>Informasi Klinis</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:pp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Pemeriksaan Penunjang</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:rp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Riwayat Perjalanan</span></a>
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
    $sta = array('Terkena Gejala','Tanpa Gejala');
    $srs = array('Ya','Tidak');
  ?>

@section('content')
  <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Informasi Klinis</h4>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6" style="margin-bottom: 20px;">
                      <a href="/datapasien" class="btn btn-light"><i class="fa fa-search"></i> Pilih Pasien</a>  
                  </div>
                  <div class="col-md-6" align="right">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus-square"> </i> Tambah Data</button>
                  </div>
              </div>
             <!--  <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#exampleModalCenter"  style="margin-bottom: 10px;"><i class="fas fa-plus-square"></i> Tambah Data Klinis</a> -->
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="save-stage" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Kategori</th>
                          <th>Jenis Kelamin</th>
                          <th>Tgl Gejala</th>
                          <th>Status Pasien</th>
                          <!-- <th></th> -->
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $dat)
                      <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>{{$dat->KAT}}</td>
                          <td>{{$dat->GENDER}}</td>
                          <td> <?= date('d M Y',strtotime($dat->TGL_GEJALA)); ?> </td>
                          <td> {{$dat->ST_PASIEN}} </td>
                          <!-- <td></td> -->
                          <td style="width: 150px;" align="center">
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#infoKlinis{{$dat->KLINIS_ID}}"><i class="fa fa-info-circle"></i></a>
                              <a href="/klinis:ed={{$dat->KLINIS_ID}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                              <a href="/klinis:del={{$dat->KLINIS_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a>
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Klinis</h5>
        </div>
        <form action="{{url('/add_klinis')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

          <div class="modal-body">
              <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-3">
                        @foreach($idk as $id)
                            <input type="hidden" name="idk" class="form-control" value="{{$id->KLINIS_ID+1}}" readonly="">
                        @endforeach
                    <div class="form-group">
                    <label>Nama Pasien</label>
                    @foreach($pas as $pa)
                    <input type="text" name="" class="form-control" value="{{$pa->NAMA}}" readonly="">
                    <input type="hidden" name="nik" class="form-control" value="{{$pa->NIK}}" readonly="">
                    @endforeach
                    
                    </div>
                  </div> 
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Tgl Pertama Kali Timbul Gejala</label>
                      <input type="date" name="tgl" class="form-control" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Demam</label>
                      <div class="row">
                          <input type="number" name="dece" class="form-control" placeholder="demam" autocomplete="off" required="" style="margin-left:20px;width: 30%;">
                          <label style="padding: 8px 0px 0px 5px;font-size: 20px;">C</label>
                        <div class="custom-control custom-checkbox" style="margin: 10px 0px 0px 20px;">
                          <input type="checkbox" class="custom-control-input" name="ride" id="ride" value="Ya"> 
                          <label class="custom-control-label" for="ride">Riwayat Demam</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Status</label>
                      <select name="status" id="sgej" class="form-control" required="">
                          <option></option>
                          @foreach($sta as $st)
                          <option>{{$st}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  </div>
                  <div  id="gejala">
                  <hr>
                  <h6 style="padding-top:-10px;text-align: center;">Gejala yang dialami</h6><br>
                  <div class="row">
                    <div class="col-md-3">
                        <style type="text/css">
                            .form-group{
                                margin-bottom: 20px;
                            }
                        </style>
                        <div class="form-group">
                          <label>Batuk</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="batuk" id="batuk1" value="Ya">
                                    <label class="custom-control-label" for="batuk1">Ya</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="batuk" id="batuk2" value="Tidak">
                                    <label class="custom-control-label" for="batuk2">Tidak</label>
                                  </div>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="batuk" id="batuk3" value="Tidak Tahu">
                                    <label class="custom-control-label" for="batuk3">Tidak Tahu</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Pilek</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="pilek" id="pilek1" value="Ya">
                                    <label class="custom-control-label" for="pilek1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="pilek" id="pilek2" value="Tidak">
                                    <label class="custom-control-label" for="pilek2">Tidak</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="pilek" id="pilek3" value="Tidak Tahu">
                                    <label class="custom-control-label" for="pilek3">Tidak Tahu</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Sakit Tenggorokkan</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sate" id="sate1" value="Ya">
                                    <label class="custom-control-label" for="sate1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sate" id="sate2" value="Tidak">
                                    <label class="custom-control-label" for="sate2">Tidak</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sate" id="sate3" value="Tidak Tahu">
                                    <label class="custom-control-label" for="sate3">Tidak Tahu</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Sesak Nafas</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sena" id="sena1" value="Ya">
                                    <label class="custom-control-label" for="sena1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sena" id="sena2" value="Tidak">
                                    <label class="custom-control-label" for="sena2">Tidak</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sena" id="sena3" value="Tidak Tahu">
                                    <label class="custom-control-label" for="sena3">Tidak Tahu</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label>Sakit Kepala</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sake" id="sake1" value="Ya">
                                    <label class="custom-control-label" for="sake1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sake" id="sake2" value="Tidak">
                                    <label class="custom-control-label" for="sake2">Tidak</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="sake" id="sake3" value="Tidak Tahu">
                                    <label class="custom-control-label" for="sake3">Tidak Tahu</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Lemak (malaise)</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="lema" id="lema1" value="Ya">
                                    <label class="custom-control-label" for="lema1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="lema" id="lema2" value="Tidak">
                                    <label class="custom-control-label" for="lema2">Tidak</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="lema" id="lema3" value="Tidak Tahu">
                                    <label class="custom-control-label" for="lema3">Tidak Tahu</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                        <label>Nyeri Otot</label>
                        <div class="form-check">
                          <table>
                            <tr>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="nyeri" id="nyeri1" value="Ya">
                                  <label class="custom-control-label" for="nyeri1">Ya</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="nyeri" id="nyeri2" value="Tidak">
                                  <label class="custom-control-label" for="nyeri2">Tidak</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="nyeri" id="nyeri3" value="Tidak Tahu">
                                  <label class="custom-control-label" for="nyeri3">Tidak Tahu</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label>Mual atau Muntah</label>
                        <div class="form-check">
                          <table>
                            <tr>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="mual" id="mual1" value="Ya">
                                  <label class="custom-control-label" for="mual1">Ya</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="mual" id="mual2" value="Tidak">
                                  <label class="custom-control-label" for="mual2">Tidak</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="mual" id="mual3" value="Tidak Tahu">
                                  <label class="custom-control-label" for="mual3">Tidak Tahu</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="form-group">
                          <label>Lainnya</label>
                          <input type="text" name="lain1" class="form-control" placeholder="sebutkan" autocomplete="off" >
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Nyeri abdomen</label>
                        <div class="form-check">
                          <table>
                            <tr>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="abdo" id="abdo1" value="Ya">
                                  <label class="custom-control-label" for="abdo1">Ya</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="abdo" id="abdo2" value="Tidak">
                                  <label class="custom-control-label" for="abdo2">Tidak</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="abdo" id="abdo3" value="Tidak Tahu">
                                  <label class="custom-control-label" for="abdo3">Tidak Tahu</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Diare</label>
                        <div class="form-check">
                          <table>
                            <tr>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="diar" id="diar1" value="Ya">
                                  <label class="custom-control-label" for="diar1">Ya</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="diar" id="diar2" value="Tidak">
                                  <label class="custom-control-label" for="diar2">Tidak</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="diar" id="diar3" value="Tidak Tahu">
                                  <label class="custom-control-label" for="diar3">Tidak Tahu</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  <hr><h6 style="padding-top:-10px;text-align: center;">Kondisi Penyerta</h6><br>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Hamil</label>
                        <div class="form-check">
                          <table>
                            <tr>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="hamil" id="hamil1" value="Ya" required="">
                                  <label class="custom-control-label" for="hamil1">Ya</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="hamil" id="hamil2" value="Tidak">
                                  <label class="custom-control-label" for="hamil2">Tidak</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Diabetes</label>
                        <div class="form-check">
                          <table>
                            <tr>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="diab" id="diab1" value="Ya" required="">
                                  <label class="custom-control-label" for="diab1">Ya</label>
                                </div>
                              </td>
                              <td>
                                <div class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="diab" id="diab2" value="Tidak">
                                  <label class="custom-control-label" for="diab2">Tidak</label>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Penyakit Jantung</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="peja" id="peja1" value="Ya" required="">
                                    <label class="custom-control-label" for="peja1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="peja" id="peja2" value="Tidak">
                                    <label class="custom-control-label" for="peja2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Hipertensi</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="hipe" id="hipe1" value="Ya" required="">
                                    <label class="custom-control-label" for="hipe1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="hipe" id="hipe2" value="Tidak">
                                    <label class="custom-control-label" for="hipe2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Keganasan</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="kega" id="kega1" value="Ya" required="">
                                    <label class="custom-control-label" for="kega1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="kega" id="kega2" value="Tidak">
                                    <label class="custom-control-label" for="kega2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Gangguan Immunologi</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="gaim" id="gaim1" value="Ya" required="">
                                    <label class="custom-control-label" for="gaim1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="gaim" id="gaim2" value="Tidak">
                                    <label class="custom-control-label" for="gaim2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Gagal Ginjal Kronis</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ggk" id="ggk1" value="Ya" required="">
                                    <label class="custom-control-label" for="ggk1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ggk" id="ggk2" value="Tidak">
                                    <label class="custom-control-label" for="ggk2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Gagal Hati Kronis</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ghk" id="ghk1" value="Ya" required="">
                                    <label class="custom-control-label" for="ghk1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ghk" id="ghk2" value="Tidak">
                                    <label class="custom-control-label" for="ghk2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>PPOK</label>
                          <div class="form-check">
                            <table>
                              <tr>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ppok" id="ppok1" value="Ya" required="">
                                    <label class="custom-control-label" for="ppok1">Ya</label>
                                  </div>
                                </td>
                                <td>
                                  <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="ppok" id="ppok2" value="Tidak">
                                    <label class="custom-control-label" for="ppok2">Tidak</label>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Lainnya</label>
                          <input type="text" name="lain2" class="form-control" placeholder="sebutkan" autocomplete="off">
                        </div>
                      </div>
                  </div>
                  <hr><h6 style="padding-top:-10px;text-align: center;">Diagnosis</h6><br>
                  <div class="row">
                      <div class="col-md-6">
                          <table>
                              <tr>
                                  <td style="width: 50%;">Pneumonia (Klinis atau Radiologi)</td>
                                  <td style="width: 10px">:</td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="pkr" id="pkr1" value="Ya" required="">
                                      <label class="custom-control-label" for="pkr1">Ya</label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="pkr" id="pkr2" value="Tidak">
                                      <label class="custom-control-label" for="pkr2">Tidak</label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="pkr" id="pkr3" value="Tidak Tahu">
                                      <label class="custom-control-label" for="pkr3">Tidak Tahu</label>
                                    </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>ARDS (Acute Respiratory Distress Syndrome)</td>
                                  <td>:</td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="ards" id="ards1" value="Ya" required="">
                                      <label class="custom-control-label" for="ards1">Ya</label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="ards" id="ards2" value="Tidak">
                                      <label class="custom-control-label" for="ards2">Tidak</label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="ards" id="ards3" value="Tidak Tahu">
                                      <label class="custom-control-label" for="ards3">Tidak Tahu</label>
                                    </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Diagnosis yang lainnya</td>
                                  <td>:</td>
                                  <td colspan ="3">
                                     <input type="text" name="lain3" class="form-control" placeholder="sebutkan" autocomplete="off">
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="col-md-6">
                          <table>
                              <tr>
                                  <td style="width: 50%;">Apakah pasien mempunyai diagnosis atau etiologi lain untuk penyakit pernafasannya?</td>
                                  <td style="width: 10px">:</td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="apa" id="apa" value="Ya" required="">
                                      <label class="custom-control-label" for="apa">Ya</label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="apa" id="apa2" value="Tidak">
                                      <label class="custom-control-label" for="apa2">Tidak</label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-radio custom-control-inline">
                                      <input class="custom-control-input" type="radio" name="apa" id="apa3" value="Tidak Tahu">
                                      <label class="custom-control-label" for="apa3">Tidak Tahu</label>
                                    </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>Jika Ya, Sebutkan</td>
                                  <td>:</td>
                                  <td colspan ="3">
                                     <input type="text" name="lain4" class="form-control" placeholder="sebutkan" autocomplete="off">
                                  </td>
                              </tr>
                          </table>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <style type="text/css">
                          table .baw td{
                              padding: 5px;
                          }
                      </style>
                      <table>
                          <tr class="baw">
                              <td>Apakah pasien dirawat di RS</td>
                              <td>:</td>
                              <td style="padding:5px 30px 5px 20px;">
                                  <select name="srs" id="trs" class="form-control" required="" onchange = "verifyAnswer()">
                                      <option></option>
                                      <option>Ya</option>
                                      <option>Tidak</option>
                                  </select>
                              </td>
                              <td>Nama RS terakhir</td>
                              <td>:</td>
                              <td style="width: 230px;"> 
                                  <input type="text" name="nrs" id="nars" class="form-control" autocomplete="off" disabled=""/>
                              </td>
                              <td>Tgl Masuk RS</td>
                              <td>:</td>
                              <td>
                                  <input type="date" name="tgs" id="tgrs" class="form-control" placeholder="sebutkan" autocomplete="off" required="" disabled=""/>
                              </td>
                          </tr>
                      </table>
                    </div>
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


  @foreach($data as $info)
  <div class="modal fade" id="infoKlinis{{$info->KLINIS_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Info Pasien</h5>
        </div>
        <?php
            $id = $info->KLINIS_ID;
            $in = DB::SELECT("select*from pasien a, klinis b where a.NIK = b.NIK and b.KLINIS_ID = '$id'");
        ?>
        @foreach($in as $det)
        <div class="modal-body">
            <div class="row">
                
                <!-- <div class="col-md-2">
                    <center><img src="assets/img/klinis.png" style="width: 60%;"></center>
                </div> -->
                
                <div class="col-md-6">
                    <center><h6 style="padding-top:-10px;text-align: center;">Identitas</h6></center>
                    <style type="text/css">
                    table tr td{
                        padding: 3px 5px 3px 5px;
                    }
                    .jar{
                        padding-right: 20px; 
                    }
                </style>
                    <table style="width: 100%;">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{$det->NAMA}}</td>
                            </tr>
                        <tr>
                            <td>Demam</td>
                            <td>:</td>
                            <td>{{$det->DEMAM}} Celcius</td>
                            <td class="jar"></td>
                            <td>Riwayat Demam : {{$det->RI_DEMAM}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <center><h6 style="padding-top:-10px;text-align: center;">Riwayat Rumah Sakit</h6></center>
                    <?php 

                        if($det->NAMA_RS == null){
                            echo "<center>tidak dirawat</center>";
                        }else{

                    ?>
                    <table style="width: 100%;">
                        <tr>
                            <td>Nama RS terakhir</td>
                            <td>:</td>
                            <td>{{$det->NAMA_RS}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal masuk RS</td>
                            <td>:</td>
                            <td>{{$det->MASUK_RS}}</td>
                        </tr>
                    </table> 
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <hr>
                    <center><h6 style="padding-top:-10px;text-align: center;">Gejala</h6></center>
                    <br>
                    <?php 
                        if($det->BATUK == null){
                            echo "<center>Tanpa Gejala</center>";
                        }else{
                    ?>
                    <table>
                        <tr>
                            <td>Batuk</td>
                            <td>:</td>
                            <td>{{$det->BATUK}}</td>
                            </tr>
                        <tr>
                            <td>Pilek</td>
                            <td>:</td>
                            <td>{{$det->PILEK}}</td>
                            </tr>
                        <tr>
                            <td>Sakit Tenggorokan</td>
                            <td>:</td>
                            <td>{{$det->S_TENGGOROKAN}}</td>
                        </tr>
                        <tr>
                            <td>Sesak Nafas</td>
                            <td>:</td>
                            <td>{{$det->S_NAFAS}}</td>
                            </tr>
                        <tr>
                            <td>Sakit Kepala</td>
                            <td>:</td>
                            <td>{{$det->S_KEPALA}} </td>
                            </tr>
                        <tr>
                            <td>Lemah (Malaise)</td>
                            <td>:</td>
                            <td>{{$det->LEMAH}}</td>
                        </tr>
                        <tr>
                            <td>Nyeri Otot</td>
                            <td>:</td>
                            <td>{{$det->NYERI_OTOT}}</td>
                            </tr>
                        <tr>
                            <td>Mual atau Muntah</td>
                            <td>:</td>
                            <td>{{$det->MUAL}}</td>
                            </tr>
                        <tr>
                            <td>Nyeri Abdomen</td>
                            <td>:</td>
                            <td>{{$det->ABDOMEN}}</td>
                        </tr>
                        <tr>
                            <td>Diare</td>
                            <td>:</td>
                            <td>{{$det->DIARE}}</td>
                            </tr>
                        <tr>
                            <td rowspan="3">Lainnya : {{$det->LAINNYA}}</td>
                        </tr>
                    </table>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <hr>
                    <center><h6 style="padding-top:-10px;text-align: center;">Kondisi Penyerta</h6></center>
                    <br>
                    <table>
                        <tr>
                            <td>Hamil</td>
                            <td>:</td>
                            <td>{{$det->HAMIL}}</td>
                            </tr>
                        <tr>
                            <td>Diabetes</td>
                            <td>:</td>
                            <td>{{$det->DIABETES}}</td>
                            </tr>
                        <tr>
                            <td>Penyakit Jantung</td>
                            <td>:</td>
                            <td>{{$det->S_JANTUNG}}</td>
                        </tr>
                        <tr>
                            <td>Hipertensi</td>
                            <td>:</td>
                            <td>{{$det->HIPERTENSI}}</td>
                            </tr>
                        <tr>
                            <td>Keganasan</td>
                            <td>:</td>
                            <td>{{$det->KEGANASAN}} </td>
                            </tr>
                        <tr>
                            <td>Gangguan Immunologi</td>
                            <td>:</td>
                            <td>{{$det->G_IMUNOLOGI}}</td>
                        </tr>
                        <tr>
                            <td>Gagal Ginjal Kronis</td>
                            <td>:</td>
                            <td>{{$det->G_GINJAL}}</td>
                            </tr>
                        <tr>
                            <td>Gagal Hati Kronis</td>
                            <td>:</td>
                            <td>{{$det->G_HATI}}</td>
                            </tr>
                        <tr>
                            <td>PPOK</td>
                            <td>:</td>
                            <td>{{$det->PPOK}}</td>
                        </tr>
                        <tr>
                            <td rowspan="3">Lainnya : {{$det->LAINNYA2}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-5">
                    <hr>
                    <center><h6 style="padding-top:-10px;text-align: center;">Diagnosis</h6></center>
                    <br>
                    <table>
                        <tr>
                            <td>Pneumonia (Klinis atau Radiologi)</td>
                            <td>:</td>
                            <td style="width: 100px;">{{$det->DIAG_1}}</td>
                        </tr>
                        <tr>
                            <td>Apakah pasien mempunyai diagnosis atau etiologi lain untuk penyakit pernafasannya ?</td>
                            <td>:</td>
                            <td>{{$det->DIAG_4}}</td>
                        </tr>
                        <tr>
                            <td>ARDS (Acute Respiratory Distress Syndrome)</td>
                            <td>:</td>
                            <td>{{$det->DIAG_2}}</td>
                        </tr>
                        <tr>
                            <td>JIka iya Sebutkan</td>
                            <td>:</td>
                            <td>{{$det->DIAG_5}}</td>
                        </tr>
                        <tr>
                            <td rowspan="3">Dianosis Lainnya, Sebutkan ! : {{$det->DIAG_3}}</td>
                        </tr>
                    </table>                                    
                </div>
            </div>
        </div>
        @endforeach
        <div class="modal-footer">
            <button  class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <script type="text/javascript">

      function verifyAnswer() {  
          //get the selected value from the dropdown list  
          var mylist = document.getElementById("trs");  
          var result = mylist.options[mylist.selectedIndex].text;  
            if (result == 'Tidak') {  
              //disable all the radio button   
              document.getElementById("nars").disabled = true;  
              document.getElementById("tgrs").disabled = true;   
            } else {  
              //enable all the radio button  
              document.getElementById("nars").disabled = false;  
              document.getElementById("tgrs").disabled = false;   
            }  
          } 
  </script>

@endsection