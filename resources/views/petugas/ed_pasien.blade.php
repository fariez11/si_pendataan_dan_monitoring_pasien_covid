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
        <li class="dropdown">
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
        </li>
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

    $gen = array('Laki-laki','Perempuan');

    $kat = array('Suspek','Kasus Probabel','Kasus Konfirmasi','Kontak Erat','ODR');

  ?>

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    Edit Data Pasien
                </div>
                    @foreach($ed as $upd)
                    <form action="/pasien:upd={{$upd->NIK}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="number" name="nik" class="form-control" value="{{$upd->NIK}}" min="1000000000000000" max="9999999999999999" autocomplete="off" readonly="" required=""   >
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{$upd->NAMA}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Nama Ortu</label>
                                    <input type="text" name="ortu" class="form-control" value="{{$upd->NAMA_ORTU}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Tgl Lahir</label>
                                    <input type="date" name="tgl" id="datepicker" class="form-control" value="{{$upd->TGL_LAHIR}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Umur</label>
                                    <div class="row" style="padding-left: 15px;">
                                        <input type="number" name="umur" id="umur" class="form-control" value="{{$upd->UMUR}}" min="0"  autocomplete="off" style="width: 30%;" required=""><span style="padding: 5px 0px 0px 5px;">tahun,</span>  <input type="number" name="bln" class="form-control" min="0" max="12" placeholder="umur" value="{{$upd->UMUR_B}}" style="width: 30%;margin-left: 10px;" required=""><span style="padding: 5px 0px 0px 5px;">bulan</span>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gend" required="">
                                      @foreach($gen as $ge)
                                      <?php if ($ge == $upd->GENDER){ ?>
                                           <option value="{{$ge}}" selected="">{{$ge}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$ge}}">{{$ge}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="kerja" class="form-control" value="{{$upd->PEKERJAAN}}" autocomplete="off" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alam" class="form-control" value="{{$upd->ALAMAT}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>RT / RW</label>
                                    <div class="row" style="padding-left:15px;">
                                        <input type="number" name="rt" class="form-control col-md-5" min="0" value="{{$upd->RT}}" autocomplete="off" style="margin-right: 40px" required="">
                                        <input type="number" name="rw" class="form-control col-md-5" min="0" value="{{$upd->RW}}" autocomplete="off" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Desa</label>
                                    <select class="form-control select2" name="kel" required="">
                                      @foreach($kel as $ka)
                                      <?php if ($ka->KEL_ID == $upd->KEL_ID){ ?>
                                           <option value="{{$ka->KEL_ID}}" selected="">{{$ka->KELURAHAN}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$ka->KEL_ID}}">{{$ka->KELURAHAN}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control select2" name="kec" required="">
                                      @foreach($kec as $ka)
                                      <?php if ($ka->KEC_ID == $upd->KEC_ID){ ?>
                                           <option value="{{$ka->KEC_ID}}" selected="">{{$ka->NAMA_KEC}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$ka->KEC_ID}}">{{$ka->NAMA_KEC}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kabupaten / Kota</label>
                                    <select class="form-control select2" name="kot" required="">
                                      @foreach($kota as $ka)
                                      <?php if ($ka->KOTA_ID == $upd->KOTA_ID){ ?>
                                           <option value="{{$ka->KOTA_ID}}" selected="">{{$ka->NAMA_KOTA}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$ka->KOTA_ID}}">{{$ka->NAMA_KOTA}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="text" name="no" class="form-control" value="{{$upd->NO_TELP}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kat" required="">
                                      @foreach($kat as $ka)
                                      <?php if ($ka == $upd->KAT){ ?>
                                           <option value="{{$ka}}" selected="">{{$ka}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$ka}}">{{$ka}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Map</label>
                                    <a href="#" class="btn btn-primary btnmap" data-toggle="modal" data-target="#map" style="display: block;">
                                            <i class="fa fa-map"></i> Map
                                        </a>
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="lng" id="lng" class="form-control" value="{{$upd->LONGITUDE}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="lat" id="lat" class="form-control" value="{{$upd->LATITUDE}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea type="text" name="ket" id="lat" class="form-control" autocomplete="off" style="height: 330px;resize: none;" required=""> {{$upd->KET}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-md-6">
                    <a href="/datapasien" class="btn btn-danger btn-block"><i class="fa fa-times-circle"></i> Batal</a>
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

    window.onload=function(){
        $('#datepicker').on('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#umur').val(age);
        });
    }    
</script>
@endsection