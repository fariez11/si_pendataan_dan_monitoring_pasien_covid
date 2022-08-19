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
          <a href="#" class="nav-link"><i data-feather="check-circle"></i><span>Pemeriksaan Penunjang</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:rp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Riwayat Perjalanan</span></a>
        </li>
        <li class="dropdown active">
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
              <h4>Detail Data Paparan</h4>
            </div>
            <div class="card-body">
                <a href="/datapasien" class="btn btn-light"><i class="fa fa-search"></i> Pilih Pasien</a>
                <br><br>
                <div class="table-responsive">
                <style type="text/css">
                        table tr td{
                            padding: 5px;
                        }
                    </style>
                <table border  style="width: 100%;">
                    <thead>
                        <tr>
                            <td colspan="5" style="width: 85%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki kontak erat dengan kasus konfirmasi dan probable COVID-19 ?</td>
                            <td colspan="1"> 
                                @foreach($data as $sp) {{$sp->STATUS}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahppr"><i class="fas fa-plus-square"> </i> Tambah Data</button></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Hubungan</th>
                            <th>Tgl Kontak Awal</th>
                            <th style="width: 100px;">Tgl Kontak Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $dat)
                        <tr style="text-align:center;">
                            <td>{{$dat->NAMA}}</td>
                            <td>{{$dat->ALAMAT}}</td>
                            <td>{{$dat->HUBUNGAN}}</td>
                            <td>
                                @if($dat->TGL_AWAL == null)

                                @else
                                    <?= date('d M Y',strtotime($dat->TGL_AWAL)); ?> 
                                @endif
                            </td>
                            <td> 
                                @if($dat->TGL_AKHIR == null)

                                @else
                                    <?= date('d M Y',strtotime($dat->TGL_AKHIR)); ?> 
                                @endif 
                            </td>
                            <td style="width: 70px;text-align: center;">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editPaparan{{$dat->PA1_ID}}"><i class="fa fa-edit"></i></a>
                                <a href="/dppr:del={{$dat->PA1_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <table border="" style="margin-top: 20px;">
                    <tr>
                        <td colspan="2">
                            <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#editPaparan{{$nid}}"><i class="fa fa-edit"></i> Edit Data</a>
                        </td>
                    </tr>
                    @foreach($pb as $pb)
                    <tr>
                        <td>
                            Apakah pasien termasuk cluster ISPA berat (demam dan pneumonia membutuhkan perawatan Rumah Sakit) yang tidak diketahui penyebabnya ?
                        </td>
                        <td style="width: 30%;padding: 5px;"> 
                            {{$pb->ISPA}}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2">
                            Apakah pasien memiliki hewan peliharaan ? <br><br>

                            Jika iya sebutkan 
                        </td>
                        <td > 
                            {{$pb->ST_HEWAN}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php 
                                if($pb->ANJING == null){

                                }else{
                                    echo " Anjing,";
                                }

                                if($pb->KUCING == null){

                                }else{
                                    echo " Kucing,";
                                }
                            ?>
                            {{$pb->S_HEWAN}}
                        </td> 
                    </tr>
                    <tr>
                        <td>Apakah pasien seorang petugas kesehatan ?</td>
                        <td> 
                            {{$pb->PET_KES}}
                       </td>
                    </tr>
                    <tr>
                        <td>
                            Jika Ya, alat pelindung di (APD) apa yang dipakai saat melakukan perawatan pada pasien suspek / probable / konfirmasi ?
                        </td>
                        <td>
                        <?php
                            if($pb->TAPD == null){ 
                                if($pb->APD1 == null){

                                }else{
                                    echo " Gown,";
                                }

                                if($pb->APD2 == null){

                                }else{
                                    echo " Masker Medis,";
                                }

                                if($pb->APD3 == null){

                                }else{
                                    echo " Sarung Tangan,";
                                }

                                if($pb->APD4 == null){

                                }else{
                                    echo " FFP3,";
                                }

                                if($pb->APD5 == null){

                                }else{
                                    echo " Masker NIOSH-N95, AN EU STANDARD FFP2,";
                                }

                                if($pb->APD6 == null){

                                }else{
                                    echo " Kacamata Pelindung (google),";
                                }

                            }else{
                                echo "Tidak Memakai APD";
                            }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Apakah melakukan prosedur yang menimbulkan erosol ? 
                        </td>
                        <td>
                            {{$pb->PROSEDUR}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Lain-lain, sebutkan :<br>
                            - {{$pb->LAINNYA}}
                        </td>   
                    </tr>
                    @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>



  <div class="modal fade" id="tambahppr" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Paparan</h5>
        </div>

        <form action="{{url('/add_dppr')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-body">

              @foreach($ipa as $ipa)
                  <input class="form-control" type="hidden" name="ipa" value="{{$ipa->PA1_ID+1}}" required="">
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
                  <label>Tanggal Kontak Awal</label>
                  <input type="date" name="tgp" class="form-control" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Tanggal Kontak Akhir</label>
                  <input type="date" name="tgt" class="form-control" autocomplete="off" required="">
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

  

  @foreach($pa as $ed)
  <div class="modal fade" id="editPaparan{{$ed->PA1_ID}}" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-md" role="document">
            <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Info Pasien</h5>
            </div>

            <?php 
                $id = $ed->PA1_ID;
                $upd = DB::SELECT("select*from paparan1 where PA1_ID = '$id'");
            ?>
            @foreach($upd as $ed)
            <form action="/dppr:upd={{$ed->PA1_ID}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nam" class="form-control" value="{{$ed->NAMA}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="ala" class="form-control" value="{{$ed->ALAMAT}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Hubungan</label>
                    <input type="text" name="hub" class="form-control" value="{{$ed->HUBUNGAN}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Kontak Pertama</label>
                    <input type="date" name="tgp" class="form-control" value="{{$ed->TGL_AWAL}}" autocomplete="off" required="">
                </div>
                <div class="form-group">
                    <label>Tanggal Kontak Terakhir</label>
                    <input type="date" name="tgt" class="form-control" value="{{$ed->TGL_AKHIR}}" autocomplete="off" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button  class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Ubah</button>
            </div>
            </form>
            @endforeach

            </div>
        </div>
  </div>
  @endforeach


    <div class="modal fade" id="editPaparan{{$nid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data Paparan</h5>
            </div>

            <?php
                $id = $ed->NIK;
                $edit = DB::SELECT("select*from paparan2 where NIK = '$id'");
            ?>
            @foreach($edit as $upd)
            <form action="/ppr:upd={{$upd->PA2_ID}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <table border="" >
                                <tr>
                                    <td colspan="1" style="width: 60%;">
                                        Apakah pasien termasuk cluster ISPA berat (demam dan pneumonia membutuhkan perawatan Rumah Sakit) yang tidak diketahui penyebabnya ?
                                    </td>
                                    <td colspan="2" style="width: 40%;padding: 5px;"> 
                                        <select name="ispa" id="ispa" class="form-control" required="" >
                                            @foreach($sta as $st)
                                              <?php if ($st == $upd->ISPA){ ?>
                                                   <option value="{{$st}}" selected="">{{$st}}</option>
                                                <?php }else{ ?>
                                                  <option value="{{$st}}">{{$st}}</option>
                                                <?php }?>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">
                                        Apakah pasien memiliki hewan peliharaan ? <br><br>

                                        Jika iya sebutkan 
                                    </td>
                                    <td colspan="2" style="padding: 5px;"> 
                                        <select name="shew" id="shew" class="form-control" required="" onchange = "verifyAnswer2()">
                                            @foreach($sta as $st)
                                              <?php if ($st == $upd->ST_HEWAN){ ?>
                                                   <option value="{{$st}}" selected="">{{$st}}</option>
                                                <?php }else{ ?>
                                                  <option value="{{$st}}">{{$st}}</option>
                                                <?php }?>
                                            @endforeach
                                       </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="anj" id="anj" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->ANJING == 'Ya' ? 'checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Anjing</span> 
                                        <input type="checkbox" name="kuc" id="kuc" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->KUCING == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Kucing</span>
                                    </td> 
                                    <td>
                                         <input type="text" class="form-control" name="hla" id="hla" value="{{$upd->S_HEWAN}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Apakah pasien seorang petugas kesehatan ?</td>
                                    <td colspan="2"> 
                                        <select name="apd" id="apd" class="form-control" required="" onchange = "verifyAnswer3()">
                                            @foreach($sta as $st)
                                              <?php if ($st == $upd->PET_KES){ ?>
                                                   <option value="{{$st}}" selected="">{{$st}}</option>
                                                <?php }else{ ?>
                                                  <option value="{{$st}}">{{$st}}</option>
                                                <?php }?>
                                            @endforeach
                                   </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jika Ya, alat pelindung di (APD) apa yang dipakai saat melakukan perawatan pada pasien suspek / probable / konfirmasi ?
                                    </td>
                                    <td colspan="2">
                                        
                                        <input type="checkbox" name="apd1" id="apd1" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->APD1 == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Gown</span> 
                                        <input type="checkbox" name="apd2" id="apd2" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->APD2 == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Masker Medis</span> 
                                        <input type="checkbox" name="apd3" id="apd3" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->APD3 == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Sarung Tangan</span>
                                        <input type="checkbox" name="apd4" id="apd4" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->APD4 == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">FFP3</span>
                                        <br>
                                        <input type="checkbox" name="apd5" id="apd5" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->APD5 == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Masker NIOSH-N95, AN EU STANDARD FFP2</span>
                                        <br>
                                        <input type="checkbox" name="apd6" id="apd6" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->APD6 == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Kacamata pelindung (google)</span> 
                                        <input type="checkbox" name="apd7" id="apd7" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" {{($upd->TAPD == 'Ya' ? ' checked' : '')}}> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Tidak Memakai APD</span>                                         
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Apakah melakukan prosedur yang menimbulkan erosol ? 
                                    </td>
                                    <td colspan="2">
                                        <select name="pro" class="form-control" required="">
                                            @foreach($sta as $st)
                                              <?php if ($st == $upd->PROSEDUR){ ?>
                                                   <option value="{{$st}}" selected="">{{$st}}</option>
                                                <?php }else{ ?>
                                                  <option value="{{$st}}">{{$st}}</option>
                                                <?php }?>
                                            @endforeach
                                       </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        Lain-lain, sebutkan <br>
                                        <textarea class="form-control" name="lain" style="height: 90px;resize: none;">{{$upd->LAINNYA}}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Batal</button>
                    <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Ubah</button>
                </div>
            </form>
            @endforeach 

            </div>
        </div>
    </div>



  @endsection