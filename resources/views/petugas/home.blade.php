@extends('layout.laypetugas')

@section('menu')
 <ul class="sidebar-menu">
    <li class="menu-header active">Main</li>
        <li class="dropdown active">
          <a href="#" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
    <li class="menu-header">Data</li>
        <li class="dropdown">
          <a href="/datapasien" class="nav-link"><i data-feather="users"></i><span>Data Pasien</span></a>
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


@section('content')
  <section class="section">
    <div class="row ">
        @foreach($jpsn as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-check-circle"></i></div>
              <div class="card-content">
                <h5 class="card-title">Pasien Terdaftar</h5>
                
                <h5>{{$jum->jum}} Pasien</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach

      @foreach($jkli as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-check-circle"></i></div>
              <div class="card-content">
                <h5 class="card-title">Informasi Klinis</h5>
                
                <h5>{{$jum->jum}} Pasien</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      
      @foreach($jppn as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-check-circle"></i></div>
              <div class="card-content">
                <h5 class="card-title">Pemeriksa Penunjang</h5>
                
                <h5>{{$jum->jum}} Pasien</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      
      @foreach($jkte as $jum)
      <div class="col-xl-3 col-lg-6">
          <div class="card l-bg-cyan">
            <div class="card-statistic-3">
              <div class="card-icon card-icon-large"><i class="fa fa-check-circle"></i></div>
              <div class="card-content">
                <h5 class="card-title">Kontak Erat</h5>
                
                <h5>{{$jum->jum}} Pasien</h5>
                <br><br>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      
    </div>
  </section>

@endsection    
    