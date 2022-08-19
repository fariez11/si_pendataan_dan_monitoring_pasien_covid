@extends('layout.layadmin')

@section('menu')
  <ul class="sidebar-menu">
    <li class="menu-header">Main</li>
    <li class="dropdown">
      <a href="/admin" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
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
    <li class="dropdown active">
      <a href="#" class="nav-link"><i data-feather="map-pin"></i><span>Data Kelurahan</span></a>
    </li>
    <li class="dropdown">
      <a href="/datatempat" class="nav-link"><i data-feather="home"></i><span>Data Tempat Pemeriksaan</span></a>
    </li>
  </ul>
@endsection
<?php 
    $no = 1;

    $lev = array('Owner','Petugas');
?>

@section('content')
  <section class="section">
      <div class="row">
        <div class="col-7">
          <div class="card">
            <div class="card-header">
              <h4>Data Kelurahan</h4>
            </div>
            <div class="card-body">
              <a href="#" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#exampleModalCenter"  style="margin-bottom: 10px;"><i class="fas fa-plus-square"></i> Tambah Data Kelurahan</a>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="save-stage" style="width: 100%;">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Kelurahan</th>                          
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $dat)
                      <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>{{$dat->KELURAHAN}}</td>
                          <td style="width: 150px;"> 
                              <a href="#" class="btn btn-icon btn-outline-warning" data-toggle="modal" data-target="#editKel{{$dat->KEL_ID}}"><i class="far fa-edit"></i></a> 
                              <a href="/kel:del={{$dat->KEL_ID}}" class="btn btn-outline-danger btn-icon" onclick="return(confirm('Anda Yakin ?'));"><i class="fas fa-trash"></i></a>
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

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kelurahan</h5>
        </div>
        <form action="{{url('/add_kel')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  @foreach($idk as $id)
                  <input type="hidden" name="idk" value="{{$id->KEL_ID+1}}" readonly="">
                  @endforeach
                    <div class="form-group">
                        <label for="pwd">Nama Kelurahan</label>
                        <input class="form-control" type="text" name="nama" placeholder="nama Kelurahan" autocomplete="off" required="">
                    </div>
                    
                </div>
              </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="far fa-times-circle"></i> Batal</button>
              <button class="btn btn-primary"><i class="far fa-check-circle"></i> Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  @foreach($data as $ed)
  <div class="modal fade" id="editKel{{$ed->KEL_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Kelurahan</h5>
        </div>
        <?php 
            $id = $ed->KEL_ID;
            $edit = DB::SELECT("select*from kelurahan where KEL_ID = '$id'");
        ?>
        @foreach($edit as $upd)
        <form action="/kel:upd={{$upd->KEL_ID}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
            <div class="modal-body">             
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pwd">Nama Kelurahan</label>
                        <input class="form-control" type="text" name="nama" value="{{$upd->KELURAHAN}}" autocomplete="off" required="">
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
              <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="far fa-times-circle"></i> Batal</button>
              <button class="btn btn-primary"><i class="far fa-check-circle"></i> Ubah</button>
            </div>
        </form>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach
 

@endsection