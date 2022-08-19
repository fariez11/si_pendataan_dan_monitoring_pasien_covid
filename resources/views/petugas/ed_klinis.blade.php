@extends('layout.laypetugas')

@section('menu')
    <ul class="sidebar-menu">
       <li class="menu-header" style="text-align: center;">Nama Pasien</li>
        <li class="dropdown">
          <a href="#" class="nav-link"><i data-feather="user-check"></i><span> @foreach($data as $nama) {{$nama->NAMA}} @endforeach</span></a>
        </li>
        <li class="menu-header">Data</li>
            <li class="dropdown active">
              <a href="#" class="nav-link"><i data-feather="check-circle"></i><span>Informasi Klinis</span></a>
            </li>
    </ul>
@endsection

  <?php
    $sta = array('Terkena Gejala','Tanpa Gejala');
    $srs = array('Ya','Tidak');
    $stp = array('Isolasi','Masih Sakit','Sembuh','Discarder','Meninggal');
  ?>

@section('content')
<section class="section">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Klinis</h4>
                </div>
                
                @foreach($data as $ud)
                <form action="/klinis:upd={{$ud->KLINIS_ID}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Nama Pasien</b></label><br>
                                {{$ud->NAMA}}
                                <input type="hidden" name="nik" value="{{$ud->NIK}}">
                            </div>
                            <br>
                            <div class="form-group">
                                <label><b>Tanggal Release</b></label>
                                <input type="date" name="release" class="form-control" autocomplete="off" value="{{$ud->TGL_RELEASE}}">
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Demam</b></label>
                                <div class="row">
                                    <input type="number" name="dece" class="form-control" value="{{$ud->DEMAM}}" autocomplete="off" required="" style="margin-left:15px;width: 30%;"><span style="padding: 7px 0px 0px 5px;font-size: 20px;">C</span>
                                    <div class="form-group" style="margin: 10px 0px 0px 35px;">
                                      <input type="checkbox" name="ride" class="form-check-input" value="Ya" style="margin-top:3px; width: 17px; height: 17px;" {{($ud->RI_DEMAM == 'Ya' ? 'checked' : '')}}> <label for="ride">Riwayat Demam</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><b>Status Terakhir Pasien</b></label>
                                <select name="stp" class="form-control" style="width: 100%;">
                                    <option></option>
                                    @foreach($stp as $stp)
                                    <?php if ($stp == $ud->ST_PASIEN){ ?>
                                       <option selected="">{{$stp}}</option>
                                    <?php }else{ ?>
                                      <option>{{$stp}}</option>
                                    <?php }?>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Tgl Pertama Kali Timbul Gejala</b></label>
                                <input type="date" name="tgl" class="form-control" autocomplete="off" value="{{$ud->TGL_GEJALA}}" required="">
                            </div>
                            <div class="form-group">
                                <label><b>Tanggal Status Pasien</b></label>
                                <input type="date" name="tsp" class="form-control" autocomplete="off" value="{{$ud->TGL_STATUS}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><b>Status Gejala</b></label>
                                <select name="status" id="esgej" class="form-control" required="">
                                 @foreach($sta as $st)
                                    <?php if ($st == $ud->STATUS){ ?>
                                       <option selected="">{{$st}}</option>
                                    <?php }else{ ?>
                                      <option>{{$st}}</option>
                                    <?php }?>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div  id="egejala">
                    <hr>
                    <h6 style="padding-top:-10px;text-align: center;">Gejala yang dialami</h6><br>
                    <div class="row" style="margin-left: 10px;">
                        <div class="col-md-3" style="padding: 0px;">
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
                                                <input class="custom-control-input" type="radio" name="batuk" id="batuk1" value="Ya" {{($ud->BATUK == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="batuk1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="batuk" id="batuk2" value="Tidak" {{($ud->BATUK == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="batuk2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="batuk" id="batuk3" value="Tidak Tahu" {{($ud->BATUK == 'Tidak Tahu' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="pilek" id="pilek1" value="Ya" {{($ud->PILEK == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="pilek1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="pilek" id="pilek2" value="Tidak" {{($ud->PILEK == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="pilek2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="pilek" id="pilek3" value="Tidak Tahu" {{($ud->PILEK == 'Tidak Tahu' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="sate" id="sate1" value="Ya" {{($ud->S_TENGGOROKAN == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sate1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sate" id="sate2" value="Tidak" {{($ud->S_TENGGOROKAN == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sate2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sate" id="sate3" value="Tidak Tahu" {{($ud->S_TENGGOROKAN == 'Tidak Tahu' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sate3">Tidak Tahu</label>
                                              </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding: 0px;">
                            <div class="form-group">
                                <label>Sesak Nafas</label>
                                <div class="form-check">
                                    <table>
                                        <tr>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sena" id="sena1" value="Ya" {{($ud->S_NAFAS == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sena1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sena" id="sena2" value="Tidak" {{($ud->S_NAFAS == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sena2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sena" id="sena3" value="Tidak Tahu" {{($ud->S_NAFAS == 'Tidak Tahu' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="sake" id="sake1" value="Ya" {{($ud->S_KEPALA == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sake1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sake" id="sake2" value="Tidak" {{($ud->S_KEPALA == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sake2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="sake" id="sake3" value="Tidak Tahu" {{($ud->S_KEPALA == 'Tidak Tahu' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="sake3">Tidak Tahu</label>
                                              </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lemah (malaise)</label>
                                <div class="form-check">
                                    <table>
                                        <tr>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="lema" id="lema1" value="Ya" {{($ud->LEMAH == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="lema1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="lema" id="lema2" value="Tidak" {{($ud->LEMAH == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="lema2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="lema" id="lema3" value="Tidak Tahu" {{($ud->LEMAH == 'Tidak Tahu' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="lema3">Tidak Tahu</label>
                                              </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding: 0px;">
                            <div class="form-group">
                                <label>Nyeri Otot</label>
                                <div class="form-check">
                                    <table>
                                        <tr>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="nyeri" id="nyeri1" value="Ya"{{($ud->NYERI_OTOT == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="nyeri1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="nyeri" id="nyeri2" value="Tidak" {{($ud->NYERI_OTOT == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="nyeri2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="nyeri" id="nyeri3" value="Tidak Tahu" {{($ud->NYERI_OTOT == 'Tidak Tahu' ? 'checked' : '')}} >
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
                                                <input class="custom-control-input" type="radio" name="mual" id="mual1" value="Ya" {{($ud->MUAL == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="mual1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="mual" id="mual2" value="Tidak" {{($ud->MUAL == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="mual2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="mual" id="mual3" value="Tidak Tahu" {{($ud->MUAL == 'Tidak Tahu' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="mual3">Tidak Tahu</label>
                                              </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Lainnya</label>
                                <input type="text" name="lain1" class="form-control" value="{{$ud->LAINNYA}}" autocomplete="off" >
                            </div>
                            
                        </div>
                        <div class="col-md-3" style="padding: 0px;">
                            <div class="form-group">
                                <label>Nyeri abdomen</label>
                                <div class="form-check">
                                    <table>
                                        <tr>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="abdo" id="abdo1" value="Ya" {{($ud->ABDOMEN == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="abdo1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="abdo" id="abdo2" value="Tidak" {{($ud->ABDOMEN == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="abdo2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="abdo" id="abdo3" value="Tidak Tahu" {{($ud->ABDOMEN == 'Tidak Tahu' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="diar" id="diar1" value="Ya" {{($ud->DIARE == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="diar1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="diar" id="diar2" value="Tidak" {{($ud->DIARE == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="diar2">Tidak</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="diar" id="diar3" value="Tidak Tahu" {{($ud->DIARE == 'Tidak Tahu' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="hamil" id="hamil1" value="Ya" required="" {{($ud->HAMIL == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="hamil1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="hamil" id="hamil2" value="Tidak" {{($ud->HAMIL == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="diab" id="diab1" value="Ya" required="" {{($ud->DIABETES == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="diab1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="diab" id="diab2" value="Tidak" {{($ud->DIABETES == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="peja" id="peja1" value="Ya" required="" {{($ud->S_JANTUNG == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="peja1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="peja" id="peja2" value="Tidak" {{($ud->S_JANTUNG == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="hipe" id="hipe1" value="Ya" required="" {{($ud->HIPERTENSI == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="hipe1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="hipe" id="hipe2" value="Tidak" {{($ud->HIPERTENSI == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="kega" id="kega1" value="Ya" required="" {{($ud->KEGANASAN == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="kega1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="kega" id="kega2" value="Tidak" {{($ud->KEGANASAN == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="gaim" id="gaim1" value="Ya" required="" {{($ud->G_IMUNOLOGI == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="gaim1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="gaim" id="gaim2" value="Tidak" {{($ud->G_IMUNOLOGI == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="ggk" id="ggk1" value="Ya" required="" {{($ud->G_GINJAL == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="ggk1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="ggk" id="ggk2" value="Tidak" {{($ud->G_GINJAL == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="ghk" id="ghk1" value="Ya" required="" {{($ud->G_HATI == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="ghk1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="ghk" id="ghk2" value="Tidak" {{($ud->G_HATI == 'Tidak' ? 'checked' : '')}}>
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
                                                <input class="custom-control-input" type="radio" name="ppok" id="ppok1" value="Ya" required="" {{($ud->PPOK == 'Ya' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="ppok1">Ya</label>
                                              </div>
                                            </td>
                                            <td>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" name="ppok" id="ppok2" value="Tidak" {{($ud->PPOK == 'Tidak' ? 'checked' : '')}}>
                                                <label class="custom-control-label" for="ppok2">Tidak</label>
                                              </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lainnya</label>
                                <input type="text" name="lain2" class="form-control" placeholder="sebutkan" autocomplete="off" value="{{$ud->LAINNYA2}}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6 style="padding-top:-10px;text-align: center;">Diagnosis</h6><br>
                    <div class="row">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td style="width: 40%;">Pneumonia (Klinis atau Radiologi)</td>
                                    <td style="width: 10px">:</td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="pkr" id="pkr1" value="Ya" required="" {{($ud->DIAG_1 == 'Ya' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="pkr1">Ya</label>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="pkr" id="pkr2" value="Tidak"{{($ud->DIAG_1 == 'Tidak' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="pkr2">Tidak</label>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="pkr" id="pkr3" value="Tidak Tahu" {{($ud->DIAG_1 == 'Tidak Tahu' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="pkr3">Tidak Tahu</label>
                                      </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ARDS (Acute Respiratory Distress Syndrome)</td>
                                    <td>:</td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="ards" id="ards1" value="Ya" required="" {{($ud->DIAG_2 == 'Ya' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="ards1">Ya</label>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="ards" id="ards2" value="Tidak" {{($ud->DIAG_2 == 'Tidak' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="ards2">Tidak</label>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="ards" id="ards3" value="Tidak Tahu" {{($ud->DIAG_2 == 'Tidak Tahu' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="ards3">Tidak Tahu</label>
                                      </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diagnosis yang lainnya</td>
                                    <td>:</td>
                                    <td colspan ="3">
                                       <input type="text" name="lain3" class="form-control" value="{{$ud->DIAG_3}}" autocomplete="off">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td style="width: 40%;">Apakah pasien mempunyai diagnosis atau etiologi lain untuk penyakit pernafasannya?</td>
                                    <td style="width: 10px">:</td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="apa" id="apa" value="Ya" required="" {{($ud->DIAG_4 == 'Ya' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="apa">Ya</label>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="apa" id="apa2" value="Tidak" {{($ud->DIAG_4 == 'Tidak' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="apa2">Tidak</label>
                                      </div>
                                    </td>
                                    <td>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" name="apa" id="apa3" value="Tidak Tahu" {{($ud->DIAG_4 == 'Tidak Tahu' ? 'checked' : '')}}>
                                        <label class="custom-control-label" for="apa3">Tidak Tahu</label>
                                      </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jika Ya, Sebutkan</td>
                                    <td>:</td>
                                    <td colspan ="3">
                                       <input type="text" name="lain4" class="form-control" value="{{$ud->DIAG_5}}" autocomplete="off">
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
                                    <td>Apakah pasien dirawat di Rumah Sakit</td>
                                    <td>:</td>
                                    <td style="padding:5px 30px 5px 20px;">
                                        <select name="srs" id="etrs" class="form-control" required="" onchange = "membatalkan()">
                                            @foreach($srs as $sr)
                                                <?php if ($sr == $ud->ST_RS){ ?>
                                                   <option value="{{$sr}}" selected="">{{$sr}}</option>
                                                <?php }else{ ?>
                                                  <option value="{{$sr}}">{{$sr}}</option>
                                                <?php }?>
                                              @endforeach
                                        </select>
                                    </td>
                                    <td>Nama RS terakhir</td>
                                    <td>:</td>
                                    <td style="width: 220px;"> 
                                      <input type="text" name="nrs" id="enars" class="form-control" value="{{$ud->NAMA_RS}}" autocomplete="off">
                                    </td>
                                    <td>Tgl Masuk RS</td>
                                    <td>:</td>
                                    <td>
                                        <input type="date" name="tglr" id="etgrs" class="form-control" value="{{$ud->MASUK_RS}}" autocomplete="off">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a href="/pasien:kl={{$ud->NIK}}" class="btn btn-danger btn-block"><i class="fa fa-times-circle"></i> Batal</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Ubah</button>
                    </div>
                </div>
            </div>
            </form>
            @endforeach
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
     function membatalkan() {  
          //get the selected value from the dropdown list  
          var mylist = document.getElementById("etrs");  
          var result = mylist.options[mylist.selectedIndex].text;  
            if (result == 'Tidak') {  
              //disable all the radio button   
              document.getElementById("enars").disabled = true;  
              document.getElementById("etgrs").disabled = true;   
            } else {  
              //enable all the radio button  
              document.getElementById("enars").disabled = false;  
              document.getElementById("etgrs").disabled = false;   
            }  
          } 
      
</script>
@endsection