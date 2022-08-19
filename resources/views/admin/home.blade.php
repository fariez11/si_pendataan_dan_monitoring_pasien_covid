@extends('layout.layadmin')

@section('menu')
 <ul class="sidebar-menu">
    <li class="menu-header active">Main</li>
    <li class="dropdown active">
      <a href="#" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
    </li>
    <li class="menu-header">Data</li>
    <li class="dropdown">
      <a href="/datapengguna" class="nav-link"><i data-feather="users"></i><span>Data Pengguna</span></a>
    </li>
    <li class="dropdown">
      <a href="/datakota" class="nav-link"><i data-feather="navigation-2"></i><span>Data Kota / Kabupaten</span></a>
    </li>
    <li class="dropdown">
      <a href="/datakecamatan" class="nav-link"><i data-feather="navigation"></i><span>Data Kecamatan</span></a>
    </li>
    <li class="dropdown">
      <a href="/datakelurahan" class="nav-link"><i data-feather="map-pin"></i><span>Data Kelurahan</span></a>
    </li>
    <li class="dropdown">
      <a href="/datatempat" class="nav-link"><i data-feather="home"></i><span>Data Tempat Pemeriksaan</span></a>
    </li>
  </ul>
@endsection


@section('content')
  <section class="section">
    <div class="row ">

      @foreach($jpeng as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-users"></i></div>
              <div class="card-content">
                <h4 class="card-title">Jumlah Pengguna</h4>
                
                <h5>{{$jum->jum}} Pengguna</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach

      @foreach($jkec as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-map-marker-alt"></i></div>
              <div class="card-content">
                <h4 class="card-title">Jumlah Kecamatan</h4>
                
                <h5>{{$jum->jum}} Kecamatan</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      
      @foreach($jkel as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-map-pin"></i></div>
              <div class="card-content">
                <h4 class="card-title">Jumlah Kelurahan</h4>
                
                <h5>{{$jum->jum}} Kelurahan</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      
      @foreach($jtmp as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-clinic-medical"></i></div>
              <div class="card-content">
                <h4 class="card-title">Jumlah Tempat</h4>
                
                <h5>{{$jum->jum}} Tempat</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
  </section>

@endsection    
    