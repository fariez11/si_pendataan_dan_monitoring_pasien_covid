@extends('layout.laypetugas')

@section('menu')
  <ul class="sidebar-menu">
    <li class="menu-header ">Main</li>
        <li class="dropdown">
          <a href="/petugas" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
    <li class="menu-header">Data</li>
        <li class="dropdown active">
          <a href="#" class="nav-link"><i data-feather="users"></i><span>Data Pasien</span></a>
        </li>
        <!-- <li class="dropdown">
          <a href="/dataklinis" class="nav-link"><i data-feather="check-circle"></i><span>Data Informasi Klinis</span></a>
        </li>
        <li class="dropdown">
          <a href="/datapenunjang" class="nav-link"><i data-feather="check-circle"></i><span>Data Pemeriksaan Penunjang</span></a>
        </li>
        <li class="dropdown">
          <a href="/datariper" class="nav-link"><i data-feather="check-circle"></i><span>Data Riwayat Perjalanan</span></a>
        </li>
        <li class="dropdown">
          <a href="/datapaparan" class="nav-link"><i data-feather="check-circle"></i><span>Data Faktor Kontak / Paparan</span></a>
        </li> -->
    <li class="menu-header">Laporan</li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Laporan</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="/datalaporanperhari">per Hari</a></li>
            <li><a class="nav-link" href="/datalaporanperbulan">per Bulan</a></li>
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
              <h4>Data Pasien</h4>
            </div>
            <div class="card-body">
              <div class="row">

                  <div class="col-md-2" style="border-right: solid 1px lightgrey;"> 
                      <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="margin: 30px 0px 10px 0px;border-right: 1px black;"><i class="fas fa-plus-square"></i> Tambah Data</a>
                  </div>
                  <div class="col-md-10">
                      <style type="text/css">
                          table tr td{
                            padding: 0px 5px 0px 5px;
                          }
                      </style>
                      <form action="/cetakpasien" style="width: 100%;">
                          <table style="width:100%;margin-top: -10px;">
                              <tr>
                                <td>
                                  <label for="password-vertical">Berdasarkan</label>
                                    <select class="form-control" name="per" required="" id="status">
                                        <option></option>
                                        <option>Hari</option>
                                        <option>Bulan</option>
                                    </select>
                                </td>
                                <td id="bulan">
                                    <label for="password-vertical">bulan</label>
                                    <select name="bulan" class="form-control">
                                        <option></option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </td>
                                <td id="tahun">
                                    <label for="password-vertical">tahun</label>
                                    <select name="tahun" class="form-control">
                                        <?php
                                        $thn_skr = date('Y');
                                        for ($x = $thn_skr; $x >= 2021; $x--) {
                                        ?>
                                            <option value="<?php echo $x ?>"><?php echo $x ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select> 
                                </td>
                                <td  id="tanggal">
                                    <label for="password-vertical">tanggal awal</label>
                                    <input type="date" class="form-control" name="tgla">
                                </td>
                                <td  id="tanggal2">
                                    <label for="password-vertical">tanggal akhir</label>
                                    <input type="date" class="form-control" name="tglb">
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
                <table class="table table-striped table-hover" id="save-stage" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>No Telp</th>
                          <th>Tgl Release</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $dat)
                      <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>{{$dat->NIK}}</td>
                          <td>{{$dat->NAMA}}</td>
                          <td>{{$dat->NO_TELP}}</td>
                              <?php $tgl = DB::SELECT("SELECT * FROM klinis where NIK = '$dat->NIK'"); ?>
                          <td>
                            @foreach($tgl as $tg)
                                @if ($tg->TGL_RELEASE == null)

                                @else
                                    <?= date('d M Y',strtotime($tg->TGL_RELEASE)); ?> 
                                @endif
                            @endforeach
                          </td>
                          <td style="width: 190px;">
                              <a href="/pasien:kl={{$dat->NIK}}" class="btn btn-success"><i class="fa fa-list"></i></a>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#infoPasien{{$dat->NIK}}"><i class="fa fa-info-circle"></i></a>
                              <a href="/pasien:ed={{$dat->NIK}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                              <a href="/pasien:del={{$dat->NIK}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fa fa-trash"></i></a>
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
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Pasien</h5>
        </div>
        <form action="{{url('/add_pasien')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="modal-body" style="margin-bottom: -30px;">
              <div class="col-md-12">
                  <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label>NIK</label>
                              <input type="number" name="nik" class="form-control" placeholder="nik" min="1000000000000000" max="9999999999999999" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" placeholder="nama" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Nama Kepala Keluarga</label>
                              <input type="text" name="ortu" class="form-control" placeholder="nama orang tua" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Tgl Lahir</label>
                              <input type="date" name="tgl" class="form-control" placeholder="tgl" autocomplete="off" required="" id="tglumur">
                          </div>
                          <div class="form-group">
                              <label>Umur</label>
                              <div class="row" style="padding-left: 15px;">
                                  <input type="number" name="umur" id="umur" class="form-control" placeholder="umur" min="0" autocomplete="off" style="width: 30%;" required="" readonly=""><span style="padding: 10px 0px 0px 5px;">tahun,</span>  <input type="number" name="bln" class="form-control" min="0" max="12" placeholder="umur" autocomplete="off" style="width: 30%;margin-left: 10px;" required=""><span style="padding: 10px 0px 0px 5px;">bulan</span>
                              </div> 
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Gender</label>
                              <select name="gend" class="form-control" required="">
                                  <option></option>
                                  @foreach($gen as $ge)
                                  <option>{{$ge}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Pekerjaan</label>
                              <input type="text" name="kerja" class="form-control" placeholder="pekerjaan" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Alamat</label>
                              <input type="text" name="alam" class="form-control" placeholder="alamat" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>RT / RW</label>
                              <div class="row" style="padding-left:15px;">
                                  <input type="number" name="rt" class="form-control col-md-5" min="0" placeholder="rt" autocomplete="off" style="margin-right: 40px" required="">
                                  <input type="number" name="rw" class="form-control col-md-5" min="0" placeholder="rw" autocomplete="off" required="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label>Kelurahan</label>
                              <select name="kel" class="form-control select2" required="" style="width: 100%;">
                                <option></option>
                                @foreach($kel as $ke)
                                <option value="{{$ke->KEL_ID}}">{{$ke->KELURAHAN}}</option>
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Kecamatan</label>
                              <select name="kec" class="form-control select2" required=""  style="width: 100%;">
                                <option></option>
                                @foreach($kec as $ke)
                                <option value="{{$ke->KEC_ID}}">{{$ke->NAMA_KEC}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Kabupaten / Kota</label>
                              <select name="kot" class="form-control select2" required=""  style="width: 100%;">
                                <option></option>
                                @foreach($kota as $ko)
                                <option value="{{$ko->KOTA_ID}}">{{$ko->NAMA_KOTA}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>No Telp</label>
                              <input type="text" name="no" class="form-control" placeholder="no telp" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Kategori</label>
                              <select name="kat" class="form-control" required="">
                                <option></option>
                                @foreach($kat as $ka)
                                <option>{{$ka}}</option>
                                @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label>Map</label>
                              <a href="#" class="btn btn-primary btnmap" data-toggle="modal" data-target="#map" style="display: block;"><i class="fa fa-map"></i> Map </a>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                              <label>Longitude</label>
                              <input type="text" name="lng" id="lng" class="form-control" placeholder="112.XXXXXXXX" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Latitude</label>
                              <input type="text" name="lat" id="lat" class="form-control" placeholder="-7.XXXXXXXXX" autocomplete="off" required="">
                          </div>
                          <div class="form-group">
                              <label>Keterangan</label>
                              <textarea type="text" name="ket" id="lat" class="form-control" placeholder="keterangan" autocomplete="off" required="" style="height: 150px;resize: none;"></textarea>
                          </div>
                      </div>
                  </div>
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


  @foreach($data as $ed)
  <div class="modal fade" id="infoPasien{{$ed->NIK}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Detail Pasien</h5>
        </div>
        <?php
            $id = $ed->NIK;
            $in = DB::SELECT("select*from pasien a, kelurahan b, kecamatan c, kota d where a.KEL_ID = b.KEL_ID and a.KEC_ID = c.KEC_ID and a.KOTA_ID = d.KOTA_ID and a.NIK = '$id'");
        ?>
        @foreach($in as $det)
        <div class="modal-body">
            <div class="row">
                <!-- <div class="col-md-2">
                    <img src="assets/img/pasien.png" style="width: 100%;">
                </div> -->
                <style type="text/css">
                    table tr td{
                        padding: 5px;
                    }
                    .jar{
                        padding-right: 15px; 
                    }
                </style>
                <div class="col-md-12">
                    <table style="width: 100%;">
                        <tr>
                            <td>Nama </td>
                            <td>:</td>
                            <td>{{$det->NAMA}}</td>
                            <td class="jar"></td>
                            <td>Kelurahan</td>
                            <td>:</td>
                            <td>{{$det->KELURAHAN}}</td>
                        </tr>
                        <tr>
                            <td>Nama Kepala Keluarga </td>
                            <td>:</td>
                            <td>{{$det->NAMA_ORTU}}</td>
                            <td class="jar"></td>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td>{{$det->NAMA_KEC}}</td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir </td>
                            <td>:</td>
                            <td>{{$det->TGL_LAHIR}}</td>
                            <td class="jar"></td>
                            <td>Kabupaten</td>
                            <td>:</td>
                            <td>{{$det->NAMA_KOTA}}</td>
                        </tr>
                        <tr>
                            <td>Umur </td>
                            <td>:</td>
                            <td>{{$det->UMUR}} tahun {{$det->UMUR_B}} bulan</td>
                            <td class="jar"></td>
                            <td>No Telp</td>
                            <td>:</td>
                            <td>{{$det->NO_TELP}}</td>
                        </tr>
                        <tr>
                            <td>Gender </td>
                            <td>:</td>
                            <td>{{$det->GENDER}}</td>
                            <td class="jar"></td>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{$det->KAT}}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan </td>
                            <td>:</td>
                            <td>{{$det->PEKERJAAN}}</td>
                            <td class="jar"></td>
                            <td rowspan="2">Keterangan</td>
                            <td rowspan="2">:</td>
                            <td rowspan="2">{{$det->KET}}</td>
                        </tr> 
                        <tr>
                            <td>ALAMAT </td>
                            <td>:</td>
                            <td>{{$det->ALAMAT}} rt {{$det->RT}} rw {{$det->RW}}</td>
                        </tr>                                      
                    </table>
                </div>
            </div>
        </div>
        @endforeach
        <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Tutup</button>
          </div>
      </div>
    </div>
  </div>
  @endforeach

  <div id="map" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div id="googleMap" style="width:100%;height:510px;"></div>
              <div class="modal-footer">
                   <button class="btn btn-info btn-block" data-dismiss="modal"><i class="fa fa-check-circle"></i> Selesai</button>
              </div>

          </div>
      </div>
  </div>

  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD9qrkGVP3Udc6Jd9KteihJQ-bnr1nd2M4" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

  <script type="text/javascript">
    var marker; 
    function taruhMarker(peta, posisiTitik){
    if( marker ){
      // pindahkan marker
      marker.setPosition(posisiTitik);
    } else {
      // buat marker baru
      marker = new google.maps.Marker({
        position: posisiTitik,
        map: peta
      });
    }
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();
    }

    function initialize() {
      var propertiPeta = {
        center:new google.maps.LatLng(-7.803156,112.0009441),
        zoom:13,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
      
      var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
      
      // even listner ketika peta diklik
      google.maps.event.addListener(peta, 'click', function(event) {
        taruhMarker(this, event.latLng);
      });
    }  
    google.maps.event.addDomListener(window, 'load', initialize);

    function previewImage() {
    document.getElementById("image-preview").style.display = "inline";
    var oFReader = new FileReader();
     oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };

  </script>

@endsection