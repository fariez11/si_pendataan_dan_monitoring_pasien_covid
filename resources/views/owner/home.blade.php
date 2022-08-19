@extends('layout.layowner')

@section('menu')
 <ul class="sidebar-menu">
    <li class="menu-header active">Main</li>
        <li class="dropdown active">
          <a href="#" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
    <li class="menu-header">Laporan</li>
        <li class="dropdown">
          <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Laporan</span></a>
          <ul class="dropdown-menu">
            <!-- <li><a class="nav-link" href="/datalaporan">Rekap</a></li> -->
            <li><a class="nav-link" href="/odatalaporanperhari">per Hari</a></li>
            <li><a class="nav-link" href="/odatalaporanperbulan">per Bulan</a></li>
          </ul>
        </li>
  </ul>
@endsection


@section('content')
  

@endsection    
    