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
          <a href="/pasien:pp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Pemeriksaan Penunjang</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:rp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Riwayat Perjalanan</span></a>
        </li>
        <li class="dropdown">
          <a href="/pasien:fp={{$nid}}" class="nav-link"><i data-feather="check-circle"></i><span>Faktor Kontak / Paparan</span></a>
        </li>
        <li class="dropdown active">
          <a href="/pasien:ke={{$nid}}" class="nav-link"><i data-feather="users"></i><span>Kontak Erat</span></a>
        </li>
  </ul>
@endsection
<?php 
    $no = 1;
    $gend = array('Laki-laki','Perempuan');
    $kat = array('Suspek','Kasus Probabel','Kasus Konfirmasi','Kontak Erat','ODR');
  ?>

@section('content')
  <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Kontak Erat<span style="color:red;">*</span></h4>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6" style="margin-bottom: 20px;">
                      <a href="/datapasien" class="btn btn-light"><i class="fa fa-search"></i> Pilih Pasien</a>  
                  </div>
                  <div class="col-md-6" align="right">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus-square"> </i> Tambah Kontak</button>
                  </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="save-stage" style="width: 100%;">
                    <thead>
                        <td>Nama </td>
                        <td>Umur</td>
                        <td>Gender</td>
                        <td>Hubungan</td>
                        <td>Alamat</td>
                        <td>No Ponsel</td>
                        <td>Aktivitas</td>
                        <td>Aksi</td>
                    </thead>
                    @foreach($data as $dat)
                    <tbody>
                        <td>{{$dat->NAMA}}</td>
                        <td>{{$dat->UMUR}} tahun</td>
                        <td>{{$dat->GENDER}}</td>
                        <td>{{$dat->HUBUNGAN}}</td>
                        <td>{{$dat->ALAMAT}}</td>
                        <td>{{$dat->NO_TELP}}</td>
                        <td>{{$dat->AKTIVITAS}}</td>
                        <td style="width: 110px;"> 
                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editKontak{{$dat->KONTAK_ID}}"><i class="fas fa-edit"></i></a>
                            <a href="/kontak:del={{$dat->KONTAK_ID}}" class="btn btn-danger" onclick="return(confirm('Anda Yakin ?'));"><i class="fas fa-trash"></i></a>
                        </td>
                    </tbody>
                    @endforeach
                </table>
              </div>
            </div>
            <div class="card-footer" style="color: black;font-weight: bold;">
                Keterangan: <br>
                <span style="color:red;">*</span>) oksigenasi membran ekstrakorporea
            </div>
          </div>
        </div>
      </div>
  </section>

  <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kontak Erat</h5>
        </div>
        <form action="{{url('/add_koner')}}" method="post" enctype="multidkrt/form-data">
              {{csrf_field()}}
          <div class="modal-body">

              @foreach($idk as $idk)
                  <input class="form-control" type="hidden" name="idk" value="{{$idk->KONTAK_ID+1}}" required="">
              @endforeach
              
               <input class="form-control" type="hidden" name="nik" value="{{$nid}}" required="">
             

              <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nam" class="form-control" placeholder="Ahmad" autocomplete="off" required="">
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="inputEmail4">umur</label>
                      <input type="number" name="umur" class="form-control" min="1" autocomplete="off" required="">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="inputPassword4">Gender</label>
                      <select name="gend" class="form-control" required="">
                          <option></option>
                          @foreach($gend as $gen)
                          <option>{{$gen}}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <div class="form-group">
                  <label>Hubungan</label>
                  <input type="text" name="hub" class="form-control" autocomplete="off" required="">
              </div> 
              <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" name="alam" class="form-control" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Nomor Ponsel yang bisa dihubungi</label>
                  <input type="text" name="no" class="form-control" autocomplete="off" required="">
              </div>
              <div class="form-group">
                  <label>Aktivitas</label>
                  <input type="text" name="akt" class="form-control" autocomplete="off" required="">
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


  @foreach($data as $upd)
  <div class="modal fade" id="editKontak{{$upd->KONTAK_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Edit Kontak Erat</h5>
        </div>
        <?php 
            $id = $upd->KONTAK_ID;
            $ed = DB::SELECT("select*from kontak where KONTAK_ID = '$id'");
        ?>
        @foreach($ed as $ed)
        <form action="/kontak:upd={{$ed->KONTAK_ID}}" method="post" enctype="multidkrt/form-data">
            {{csrf_field()}}
        <div class="modal-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nam" class="form-control" value="{{$ed->NAMA}}" autocomplete="off" required="">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">umur</label>
                    <input type="number" name="umur" class="form-control" min="1" max="60" value="{{$ed->UMUR}}" placeholder="1 - 60 tahun" autocomplete="off" required="">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Gender</label>
                    <select name="gend" class="form-control" required="">
                        <option></option>
                        @foreach($gend as $ge)
                            <?php if ($ge == $ed->GENDER){ ?>
                               <option value="{{$ge}}" selected="">{{$ge}}</option>
                            <?php }else{ ?>
                              <option value="{{$ge}}">{{$ge}}</option>
                            <?php }?>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Hubungan</label>
                <input type="text" name="hub" class="form-control" value="{{$ed->HUBUNGAN}}" autocomplete="off" required="">
            </div> 
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alam" class="form-control" value="{{$ed->ALAMAT}}" autocomplete="off" required="">
            </div>
            <div class="form-group">
                <label>Nomor Ponsel yang bisa dihubungi</label>
                <input type="text" name="no" class="form-control" value="{{$ed->NO_TELP}}" autocomplete="off" required="">
            </div>
            <div class="form-group">
                <label>Aktivitas</label>
                <input type="text" name="akt" class="form-control" value="{{$ed->AKTIVITAS}}" autocomplete="off" required="">
            </div>
        </div>
        <div class="modal-footer">
            <button  class="btn btn-danger" data-dismiss="modal"><i class="feather icon-x-circle"></i> Batal</button>
            <button class="btn btn-primary"><i class="feather icon-check-circle"></i> Ubah</button>
        </div>
        </form>
        @endforeach
      </div>
    </div>
  </div>
  @endforeach

     </div>
      </div>
  </div>


@endsection