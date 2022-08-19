@extends('layout.layowner')

@section('menu')
 <ul class="sidebar-menu">
    <li class="menu-header">Main</li>
        <li class="dropdown">
          <a href="#" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
    <li class="menu-header">Laporan</li>
        <li class="dropdown active">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Laporan</span></a>
          <ul class="dropdown-menu">
            <!-- <li><a class="nav-link" href="/datalaporan">Rekap</a></li> -->
            <li class="active"><a class="nav-link" href="/odatalaporanperhari">per Hari</a></li>
            <li><a class="nav-link" href="/odatalaporanperbulan">per Bulan</a></li>
          </ul>
        </li>
  </ul>
@endsection

<?php 
    $no = 1;
    $gen = array('Laki-laki','Perempuan');
    $kat = array('Suspek','Kasus Probabel','Kasus Konfirmasi','Kontak Erat','ODR');
?>

@section('content')
  <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Laporan berdasarkan Hari</h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6" style="border-right: solid 1px lightgrey;">
                        <form action="/datalaporanperhari">
                            <table style="width:100%;">
                                <tr>
                                    <td>
                                        <label for="password-vertical">tanggal awal</label>
                                        <input type="date" class="form-control" value="{{$tga}}" name="tgla" required="">
                                    </td>
                                    <td>
                                        <label for="password-vertical">tanggal akhir</label>
                                        <input type="date" class="form-control" value="{{$tgb}}" name="tglb" required="">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" style="margin-top: 25px;"><i class="fa fa-search"></i> Cari</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="/cetaklaporanperhari">
                            <table style="width:100%;">
                                <tr>
                                    <td>
                                        <label for="password-vertical">tanggal awal</label>
                                        <input type="date" class="form-control" value="{{$tga}}" name="tgla" required="">
                                    </td>
                                    <td>
                                        <label for="password-vertical">tanggal akhir</label>
                                        <input type="date" class="form-control" value="{{$tgb}}" name="tglb" required="">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" style="margin-top: 25px;"><i class="fa fa-print"></i> Cetak</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <br>

                <div class="table-responsive">
                    <table border="" style="width: 100%;">
                        <tr style="background: lightgrey;text-align: center;font-weight: bold;">
                            <td style="padding: 10px;">No</td>
                            <td colspan="3"> STATUS</td>
                            <td> JUMLAH PER HARI</td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>1</b></td>
                            <td colspan="4"><b>DATA KASUS SUSPEK</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus suspek</td>
                            <td style="text-align: center;">@foreach($ka1a as $ka1a) {{$ka1a->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus probable</td>
                            <td style="text-align: center;">@foreach($ka1b as $ka1b) {{$ka1b->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus suspek diisolasi</td>
                            <td style="text-align: center;">@foreach($ka1c as $ka1c) {{$ka1c->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus suspek discarder</td>
                            <td style="text-align: center;">@foreach($ka1d as $ka1d) {{$ka1d->jum}} orang @endforeach</td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>2</b></td>
                            <td colspan="4"><b>DATA KASUS KONFIRMASI</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi</td>
                            <td style="text-align: center;">@foreach($ka2a as $ka2a) {{$ka2a->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi bergejala</td>
                            <td style="text-align: center;">@foreach($ka2b as $ka2b) {{$ka2b->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi tanpa gejala</td>
                            <td style="text-align: center;">@foreach($ka2c as $ka2c) {{$ka2c->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi perjalanan (impor)</td>
                            <td style="text-align: center;">@foreach($ka2d as $ka2d) {{$ka2d->jum}} orang @endforeach</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi kontak *)</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi tidak ada riwayat perjalanan atau kontak erat **)</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Selesai isolasi kasus konfirmasi hari ini</td>
                            <td style="text-align: center;">@foreach($ka2g as $ka2g) {{$ka2g->jum}} orang @endforeach</td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>3</b></td>
                            <td colspan="4"><b>DATA PEMANTAUAN KONTAK ERAT</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus konfirmasi dilakukan pelacakan kontak erat</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kontak erat baru</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kontak erat menjadi kasus suspek</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kontak erat menjadi kasus konfirmasi</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kontak erat mangkir pemantauan</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kontak erat discarder</td>
                            <td style="text-align: center;">@foreach($ka3f as $ka3f) {{$ka3f->jum}} orang @endforeach</td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>4</b></td>
                            <td colspan="4"><b>DATA KASUS MENINGGAL</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Meninggal karena RT-PCR (+)</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Meninggal Probabel</td>
                            <td style="text-align: center;">@foreach($ka4b as $ka4b) {{$ka4b->jum}} orang @endforeach</td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>5</b></td>
                            <td colspan="4"><b>PEMERIKSAAN RT-PCR</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah kasus diambil specimen/swab</td>
                            <td style="text-align: center;">@foreach($ka5a as $ka5a) {{$ka5a->jum}} orang @endforeach</td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>6</b></td>
                            <td colspan="4"><b>SURVEILANS SEROLOGI</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah rapid test</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah rapid test reaktif</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah reaktif periksa RTPCR</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3">Jumlah reaktif dengan RTPCR(+)</td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr style="background-color: lightgrey;">
                            <td style="text-align: center;"><b>7</b></td>
                            <td colspan="4"><b>ISOLASI / KARANTINA HARI INI</b></td>
                        </tr>
                        <tr style="text-align: center;">
                            <td></td>
                            <td style="padding: 10px;">KLASIFIKASI</td>
                            <td>RS.RUJUKAN</td>
                            <td>RS.DARURAT</td>
                            <td>ISOLASI / KARANTINA MANDIRI</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jumlah kasus suspek + kasus probabel</td>
                            <td></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jumlah kasus konfirmasi</td>
                            <td></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Jumlah kontak erat sedang dipantau</td>
                            <td></td>
                            <td style="text-align: center;"></td>
                            <td style="text-align: center;"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card-footer" style="color: black;font-weight: bold;">
                Keterangan: <br>
                - *) jumlah kontak erat menjadi konfirmasi + jumlah kasus konfirmasi dengan faktor resiko kontak yang tidak berasal dari pelacakan kontak erat <br>
                - **) jumlah kasus diambil spesimen/swab - (jumlah konfirmasi perjalanan + jumlah konfirmasi kontak)
            </div>
          </div>
        </div>
      </div>
  </section>

@endsection    
    