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
        <li class="dropdown active">
          <a href="#" class="nav-link"><i data-feather="check-circle"></i><span>Pemeriksaan Penunjang</span></a>
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
    $has = array('','Positif','Negatif');
    $has2 = array('','Reaktif','Non Reaktif');
  ?>

@section('content')
  <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Pemeriksaan Penunjang</h4>
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
                          <td>{{$no++}}</td>
                          <td>{{$dat->NAMA}}</td>
                          <td>{{$dat->GENDER}}</td>
                          <td>{{$dat->PEKERJAAN}}</td>
                          <td style="width: 150px;">
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#infoPenunjang{{$dat->PENJ_ID}}"><i class="fa fa-info-circle"></i></a>
                              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editPenunjang{{$dat->PENJ_ID}}"><i class="fa fa-edit"></i></a>
                              <a href="/pen:del={{$dat->PENJ_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a>
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
        <form action="{{url('/add_penunjang')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h6 style="padding-top:-10px;text-align: center;">Spesimen</h6><br> -->
                    <style type="text/css">
                        table tr td{
                            padding: 5px;
                        }
                    </style>
                      @foreach($idp as $id)
                          <input type="hidden" name="idp" class="form-control" value="{{$id->PENJ_ID+1}}" readonly="">
                      @endforeach
                      <input type="hidden" name="nik" value="{{$nid}}" readonly="">
                      <br>
                      <table border="" style="width: 100%;">
                          <tr>
                              <td rowspan="2">Jenis Pemeriksaan / Spesimen</td>
                              <td colspan="3" style="text-align: center;">Pengambilan Spesimen</td>
                          </tr>
                          <tr>
                              <td style="text-align: center;">Tanggal Pengambilan</td>
                              <td style="text-align: center;">Tempat Pemeriksaan</td>
                              <td style="text-align: center;">Hasil</td>
                          </tr>
                          <tr>
                              <td colspan="4" style="background-color: lightgrey;">Laboratorium Konfirmasi</td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn1" class="form-control" placeholder="sebutkan" autocomplete="off" value="Nasopharyngeal (NP) Swab" style="border:none;background-color: white;" readonly=""></td>
                              <td><input type="date" name="tg1" class="form-control" style="width: 160px;"></td>
                              <td>
                                  <select name="tp1" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <select name="hs1" class="form-control">
                                      @foreach($has as $ha)
                                      <option>{{$ha}}</option>
                                      @endforeach
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn2" class="form-control" placeholder="sebutkan" autocomplete="off" value="Oropharyngeal (NP) Swab" style="border:none;background-color: white;" readonly=""></td>
                              <td><input type="date" name="tg2" class="form-control" style="width: 160px;"  ></td>
                              <td>
                                  <select name="tp2" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <select name="hs2" class="form-control">
                                      @foreach($has as $ha)
                                      <option>{{$ha}}</option>
                                      @endforeach
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn3" class="form-control" placeholder="sebutkan" autocomplete="off" value="Sputum" style="border:none;background-color: white;" readonly=""></td>
                              <td><input type="date" name="tg3" class="form-control" style="width: 160px;"  ></td>
                              <td>
                                  <select name="tp3" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <input type="text" name="hs3" class="form-control" autocomplete="off">
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn4" class="form-control" placeholder="sebutkan" autocomplete="off" value="Serum" style="border:none;background-color: white;" readonly=""></td>
                              <td><input type="date" name="tg4" class="form-control" style="width: 160px;"  ></td>
                              <td>
                                  <select name="tp4" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <input type="text" name="hs4" class="form-control" autocomplete="off">
                              </td>
                          </tr>
                          <tr>
                              <td colspan="4" style="background-color: lightgrey;">Pemeriksaan Lain</td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn5" class="form-control" placeholder="sebutkan" autocomplete="off" value="Rapid Antigen" style="border:none;background-color: white;" readonly=""></td>
                              <td><input type="date" name="tg5" class="form-control" style="width: 160px;"  ></td>
                              <td>
                                  <select name="tp5" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <select name="hs5" class="form-control">
                                      @foreach($has as $ha)
                                      <option>{{$ha}}</option>
                                      @endforeach
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn6" class="form-control" placeholder="sebutkan" autocomplete="off" value="Rapid Antibody" style="border:none;background-color: white;" readonly=""></td>
                              <td><input type="date" name="tg6" class="form-control" style="width: 160px;"  ></td>
                              <td>
                                  <select name="tp6" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <select name="hs6" class="form-control">
                                      @foreach($has2 as $ha2)
                                      <option>{{$ha2}}</option>
                                      @endforeach
                                  </select>
                              </td>
                          </tr>
                          <tr>
                              <td style="width: 235px;"><input type="text" name="jn7" class="form-control" autocomplete="off" placeholder="Lainnya ..."></td>
                              <td><input type="date" name="tg7" class="form-control" style="width: 160px;"></td>
                              <td>
                                  <select name="tp7" class="form-control select2" style="width: 200px;">
                                    <option></option>
                                    @foreach($tmp as $tm)
                                    <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                    @endforeach
                                  </select>
                              </td>
                              <td>
                                  <input type="text" name="hs7" class="form-control">
                              </td>
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


  @foreach($data as $info)
  <div class="modal fade" id="infoPenunjang{{$info->PENJ_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Info Pemeriksaan Penunjang</h5>
        </div>
        <?php
            $id = $info->PENJ_ID;
            $in = DB::SELECT("select*from p_penunjang  where PENJ_ID = '$id'");
        ?>
        @foreach($in as $det)
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <style type="text/css">
                        
                        table tr td{
                            padding: 5px;
                        }

                    </style>
                    <table border="" style="width: 100%;text-align: center;">
                        <tr>
                            <td rowspan="2">Jenis Pemeriksaan / Spesimen</td>
                            <td colspan="3" style="text-align: center;">Pengambilan Spesimen</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Tanggal Pengambilan</td>
                            <td style="text-align: center;">Tempat Pemeriksaan</td>
                            <td style="text-align: center;">Hasil</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background-color: lightgrey;text-align: left;">Laboratorium Konfirmasi</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;">
                                <input type="text" name="jn1" class="form-control" placeholder="sebutkan" autocomplete="off" value="Nasopharyngeal (NP) Swab" style="border:none;background-color: white;" readonly="">
                            </td>
                            <td>
                              <?php
                                if($det->TGLA == null){
                                    echo "";
                                }else{
                                    echo date('d M Y',strtotime($det->TGLA));
                                }
                              ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPA' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLA}}</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn2" class="form-control" placeholder="sebutkan" autocomplete="off" value="Oropharyngeal (NP) Swab" style="border:none;background-color: white;" readonly=""></td>
                            <td><?php
                                    if($det->TGLB == null){
                                        echo "";
                                    }else{
                                        echo date('d M Y',strtotime($det->TGLB));
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPB' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLB}}</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn3" class="form-control" placeholder="sebutkan" autocomplete="off" value="Sputum" style="border:none;background-color: white;" readonly=""></td>
                            <td>
                                <?php
                                    if($det->TGLC == null){
                                        echo "";
                                    }else{
                                        echo date('d M Y',strtotime($det->TGLC));
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPC' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLC}}</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn4" class="form-control" placeholder="sebutkan" autocomplete="off" value="Serum" style="border:none;background-color: white;" readonly=""></td>
                            <td>
                                <?php
                                    if($det->TGLD == null){
                                        echo "";
                                    }else{
                                        echo date('d M Y',strtotime($det->TGLD));
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPD' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLD}}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background-color: lightgrey;text-align: left;">Pemeriksaan Lain</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn5" class="form-control" placeholder="sebutkan" autocomplete="off" value="Rapid Antigen" style="border:none;background-color: white;" readonly=""></td>
                            <td>
                                <?php
                                    if($det->TGLE == null){
                                        echo "";
                                    }else{
                                        echo date('d M Y',strtotime($det->TGLE));
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPE' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLE}}</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn6" class="form-control" placeholder="sebutkan" autocomplete="off" value="Rapid Antibody" style="border:none;background-color: white;" readonly=""></td>
                            <td>
                                <?php
                                    if($det->TGLF == null){
                                        echo "";
                                    }else{
                                        echo date('d M Y',strtotime($det->TGLF));
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPF' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLF}}</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn2" class="form-control"  autocomplete="off" value="{{$det->JNG}}" style="border:none;background-color: white;" readonly=""></td>
                            <td>
                                <?php
                                    if($det->TGLG == null){
                                        echo "";
                                    }else{
                                        echo date('d M Y',strtotime($det->TGLG));
                                    }
                                ?>
                            </td>
                            <td>
                            <?php 
                                $tmpa = DB::SELECT("select*from tempat_pemeriksaan where TMP_ID = '$det->TMPG' ");
                                foreach($tmpa as $tm){ 
                                  echo $tm->NAMA_TEMPAT;
                                }
                            ?>
                            </td>
                            <td>{{$det->HSLG}}</td>
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


  @foreach($data as $edit)
  <div class="modal fade" id="editPenunjang{{$edit->PENJ_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Pemeriksaan Penunjang</h5>
        </div>
        <?php
            $id = $edit->PENJ_ID;
            $ed = DB::SELECT("select*from p_penunjang where PENJ_ID = '$id'");
            $tmp = DB::SELECT("select*from tempat_pemeriksaan");
        ?>
        @foreach($ed as $upd)
        <form action="/pen:upd={{$upd->PENJ_ID}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="modal-body">
        <div class="col-md-12">
            <div class="row">
                <table border="" style="width: 100%;">
                        <tr>
                            <td rowspan="2">Jenis Pemeriksaan / Spesimen</td>
                            <td colspan="3" style="text-align: center;">Pengambilan Spesimen</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">Tanggal Pengambilan</td>
                            <td style="text-align: center;width: 200px;">Tempat Pemeriksaan</td>
                            <td style="text-align: center;">Hasil</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background-color: lightgrey;">Laboratorium Konfirmasi</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn1" class="form-control" placeholder="sebutkan" autocomplete="off" value="Nasopharyngeal (NP) Swab" style="border:none;background-color: white;" readonly=""></td>
                            <td><input type="date" name="tg1" class="form-control" style="width: 160px;" value="{{$upd->TGLA}}"></td>
                            <td>
                                <select class="form-control select2" name="tp1" style="width: 200px;">
                                    <?php
                                      if($upd->TMPA == null){
                                    ?>
                                        <option></option>
                                        @foreach($tmp as $tm)
                                        <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                        @endforeach
                                    <?php
                                      }else{
                                          foreach($tmp as $tm){
                                            if ($tm->TMP_ID == $upd->TMPA){ ?>
                                              <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php }else{ ?>
                                              <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php } 
                                          }
                                      }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="hs1">
                                  @foreach($has as $ha)
                                  <?php if ($ha == $upd->HSLA){ ?>
                                       <option selected="">{{$ha}}</option>
                                    <?php }else{ ?>
                                      <option>{{$ha}}</option>
                                    <?php }?>
                                  @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn2" class="form-control" placeholder="sebutkan" autocomplete="off" value="Oropharyngeal (NP) Swab" style="border:none;background-color: white;" readonly=""></td>
                            <td><input type="date" name="tg2" class="form-control" style="width: 160px;" value="{{$upd->TGLB}}"></td>
                            <td>
                                <select class="form-control select2" name="tp2" style="width: 200px;">
                                    <?php
                                        if($upd->TMPB == null){
                                    ?>
                                          <option></option>
                                          @foreach($tmp as $tm)
                                          <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                          @endforeach
                                    <?php
                                        }else{
                                            foreach($tmp as $tm){
                                              if ($tm->TMP_ID == $upd->TMPB){ ?>
                                                <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                              <?php }else{ ?>
                                                <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                              <?php } 
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="hs2">
                                  @foreach($has as $ha)
                                  <?php if ($ha == $upd->HSLB){ ?>
                                       <option selected="">{{$ha}}</option>
                                    <?php }else{ ?>
                                      <option>{{$ha}}</option>
                                    <?php }?>
                                  @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn3" class="form-control" placeholder="sebutkan" autocomplete="off" value="Sputum" style="border:none;background-color: white;" readonly=""></td>
                            <td><input type="date" name="tg3" class="form-control" style="width: 160px;" value="{{$upd->TGLC}}"></td>
                            <td>
                                <select class="form-control select2" name="tp3" style="width: 200px;">
                                  <?php
                                      if($upd->TMPC == null){
                                  ?>
                                        <option></option>
                                        @foreach($tmp as $tm)
                                        <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                        @endforeach
                                  <?php
                                      }else{
                                          foreach($tmp as $tm){
                                            if ($tm->TMP_ID == $upd->TMPC){ ?>
                                              <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php }else{ ?>
                                              <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php } 
                                          }
                                      }
                                  ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="hs3" class="form-control" value="{{$upd->HSLC}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn4" class="form-control" placeholder="sebutkan" autocomplete="off" value="Serum" style="border:none;background-color: white;" readonly=""></td>
                            <td><input type="date" name="tg4" class="form-control" style="width: 160px;" value="{{$upd->TGLD}}"></td>
                            <td>
                                <select class="form-control select2" name="tp4" style="width: 200px;">
                                  <?php
                                      if($upd->TMPD == null){
                                  ?>
                                        <option></option>
                                        @foreach($tmp as $tm)
                                        <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                        @endforeach
                                  <?php
                                      }else{
                                          foreach($tmp as $tm){
                                            if ($tm->TMP_ID == $upd->TMPD){ ?>
                                              <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php }else{ ?>
                                              <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php } 
                                          }
                                      }
                                  ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="hs4" class="form-control" value="{{$upd->HSLD}}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="background-color: lightgrey;">Pemeriksaan Lain</td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn5" class="form-control" placeholder="sebutkan" autocomplete="off" value="Rapid Antigen" style="border:none;background-color: white;" readonly=""></td>
                             <td><input type="date" name="tg5" class="form-control" style="width: 160px;" value="{{$upd->TGLE}}"></td>
                            <td>
                                <select class="form-control select2" name="tp5" style="width: 200px;">
                                  <?php
                                      if($upd->TMPE == null){
                                  ?>
                                        <option></option>
                                        @foreach($tmp as $tm)
                                        <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                        @endforeach
                                  <?php
                                      }else{
                                          foreach($tmp as $tm){
                                            if ($tm->TMP_ID == $upd->TMPE){ ?>
                                              <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php }else{ ?>
                                              <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php } 
                                          }
                                      }
                                  ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="hs5">
                                  @foreach($has as $ha)
                                  <?php if ($ha == $upd->HSLE){ ?>
                                       <option selected="">{{$ha}}</option>
                                    <?php }else{ ?>
                                      <option>{{$ha}}</option>
                                    <?php }?>
                                  @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn6" class="form-control" placeholder="sebutkan" autocomplete="off" value="Rapid Antibody" style="border:none;background-color: white;" readonly=""></td>
                             <td><input type="date" name="tg6" class="form-control" style="width: 160px;" value="{{$upd->TGLF}}"></td>
                            <td>
                                <select class="form-control select2" name="tp6" style="width: 200px;">
                                  <?php
                                      if($upd->TMPF == null){
                                  ?>
                                        <option></option>
                                        @foreach($tmp as $tm)
                                        <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                        @endforeach
                                  <?php
                                      }else{
                                          foreach($tmp as $tm){
                                            if ($tm->TMP_ID == $upd->TMPF){ ?>
                                              <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php }else{ ?>
                                              <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                            <?php } 
                                          }
                                      }
                                  ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="hs6">
                                  @foreach($has2 as $ha2)
                                  <?php if ($ha2 == $upd->HSLF){ ?>
                                       <option selected="">{{$ha2}}</option>
                                    <?php }else{ ?>
                                      <option>{{$ha2}}</option>
                                    <?php }?>
                                  @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 235px;"><input type="text" name="jn7" class="form-control" autocomplete="off" value="{{$upd->JNG}}"></td>
                            <td><input type="date" name="tg7" class="form-control" style="width: 160px;" value="{{$upd->TGLG}}"></td>
                            <td>
                              <select class="form-control select2" name="tp7" style="width: 200px;">
                                  <?php
                                    if($upd->TMPG == null){
                                  ?>
                                      <option></option>
                                      @foreach($tmp as $tm)
                                      <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                      @endforeach
                                  <?php
                                    }else{
                                        foreach($tmp as $tm){
                                          if ($tm->TMP_ID == $upd->TMPG){ ?>
                                            <option value="{{$tm->TMP_ID}}" selected="">{{$tm->NAMA_TEMPAT}}</option>
                                          <?php }else{ ?>
                                            <option value="{{$tm->TMP_ID}}">{{$tm->NAMA_TEMPAT}}</option>
                                          <?php } 
                                        }
                                    }
                                  ?>
                                </select>
                              </td>
                            <td>
                                <input type="text" name="hs7" class="form-control" value="{{$upd->HSLG}}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button  class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
            <button class="btn btn-primary"><i class="fa fa-edit"></i> Ubah</button>
        </div>
        </form>
        @endforeach

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