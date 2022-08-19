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
              <h4>Tambah Data Paparan</h4>
            </div>
            <form action="{{url('/add_ppr')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <a href="/datapasien" class="btn btn-light"><i class="fa fa-search"></i> Pilih Pasien</a>
                        <input type="hidden" name="nik" value="{{$nid}}" readonly>
                        @foreach($ipa as $ipa)
                            <input class="form-control" type="hidden" name="iaa" value="{{$ipa->PA1_ID+1}}" required="">
                            <input class="form-control" type="hidden" name="iab" value="{{$ipa->PA1_ID+2}}" required="">
                        @endforeach
                        <style type="text/css">
                            table tr td{
                                padding: 5px;
                            }
                        </style>
                        <table border="" style="width: 100%;margin-top: 10px;">
                            <tr>
                                <td colspan="4" style="width: 85%;padding: 5px;">Dalam 14 hari sebelum sakit, apakah memiliki kontak erat dengan kasus konfirmasi dan probable COVID-19 ?</td>
                                <td colspan="1" style="width: 15%;"> 
                                    <select name="sta" id="sta" class="form-control" required="" onchange = "verifyAnswer()">
                                        <option></option>
                                        @foreach($sta as $st)
                                        <option>{{$st}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="text-align: center;background-color: lightgrey">
                                <td>Nama</td>
                                <td>Alamat</td>
                                <td>Hubungan</td>
                                <td>Tgl Kontak Awal</td>
                                <td style="width: 100px;">Tgl Kontak Akhir</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td><input class="form-control" type="text" name="nam" id="nam" placeholder="Ahmad" disabled=""></td>
                                <td><input class="form-control" type="text" name="ala" id="ala" placeholder="Jl.Mawar" disabled=""></td>
                                <td><input class="form-control" type="text" name="hub" id="hub" placeholder="Teman" disabled=""></td>
                                <td><input class="form-control" type="date" name="tgp" id="tgp" style="width: 160px;" disabled=""></td>
                                <td><input class="form-control" type="date" name="tgt" id="tgt" style="width: 150px;" disabled=""></td>
                            </tr>
                            <tr style="text-align: center;">
                                <td><input class="form-control" type="text" name="nam2" id="nam2" placeholder="Ahmad" disabled=""></td>
                                <td><input class="form-control" type="text" name="ala2" id="ala2" placeholder="Jl.Mawar" disabled=""></td>
                                <td><input class="form-control" type="text" name="hub2" id="hub2" placeholder="Teman" disabled=""></td>
                                <td><input class="form-control" type="date" name="tgp2" id="tgp2"style="width: 160px;" disabled=""></td>
                                <td><input class="form-control" type="date" name="tgt2" id="tgt2"style="width: 150px;" disabled=""></td>
                            </tr>
                            @foreach($ipb as $ib)
                                <input class="form-control" type="hidden" name="iba" value="{{$ib->PA2_ID+1}}" required="">
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    Apakah pasien termasuk cluster ISPA berat (demam dan pneumonia membutuhkan perawatan Rumah Sakit) yang tidak diketahui penyebabnya ?
                                </td>
                                <td colspan="2" style="width: 15%;padding: 5px;"> 
                                    <select name="ispa" id="ispa" class="form-control" required="" >
                                        <option></option>
                                        @foreach($sta as $st)
                                        <option>{{$st}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" rowspan="2">
                                    Apakah pasien memiliki hewan peliharaan ? <br><br>

                                    Jika iya sebutkan 
                                </td>
                                <td colspan="2" style="width: 15%;padding: 5px;"> 
                                    <select name="shew" id="shew" class="form-control" required="" onchange = "verifyAnswer2()">
                                        <option></option>
                                        @foreach($sta as $st)
                                        <option>{{$st}}</option>
                                        @endforeach
                                   </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="anj" id="anj" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Anjing</span> 
                                    <input type="checkbox" name="kuc" id="kuc" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Kucing</span>
                                </td> 
                                <td>
                                     <input type="text" class="form-control" name="hla" id="hla" placeholder="lainnya" disabled="">
                                </td>
                            </tr>
                            <tr>
                                <td  colspan="3" >Apakah pasien seorang petugas kesehatan ?</td>
                                <td  colspan="2"> 
                                    <select name="apd" id="apd" class="form-control" required="" onchange = "verifyAnswer3()">
                                        <option></option>
                                        @foreach($sta as $st)
                                        <option>{{$st}}</option>
                                        @endforeach
                                   </select>
                               </td>
                            </tr>
                            <tr>
                                <td  colspan="3">
                                    Jika Ya, alat pelindung diri (APD) apa yang dipakai saat melakukan perawatan pada pasien suspek / probable / konfirmasi ?
                                </td>
                                <td colspan="2">
                                    <input type="checkbox" name="apd1" id="apd1" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Gown</span> 
                                    <input type="checkbox" name="apd2" id="apd2" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Masker Medis</span> 
                                    <input type="checkbox" name="apd3" id="apd3" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Sarung Tangan</span>
                                    <br>
                                    <input type="checkbox" name="apd5" id="apd5" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Masker NIOSH-N95, AN EU STANDARD FFP2</span>
                                    <br>
                                    <input type="checkbox" name="apd6" id="apd6" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Kacamata pelindung (google)</span> 
                                    <input type="checkbox" name="apd4" id="apd4" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">FFP3</span>
                                    <br>
                                    <span>atau </span>
                                    <input type="checkbox" name="apd7" id="apd7" class="form-check-input" style="width: 20px;height: 15px;margin-left: 5px;" value="Ya" disabled=""> <span style="margin-top:10px;padding: 10px 0px 0px 30px;">Tidak Memakai APD</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    Apakah melakukan prosedur yang menimbulkan erosol ? 
                                </td>
                                <td colspan="2">
                                    <select name="pro" class="form-control" required="">
                                        <option></option>
                                        @foreach($sta as $st)
                                        <option>{{$st}}</option>
                                        @endforeach
                                   </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    Lain-lain, sebutkan <br>
                                    <textarea class="form-control" name="lain" style="height: 100px;resize: none;"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer" align="right">
                <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
            </div>

            </form>
          </div>
        </div>
      </div>
  </section>

  <script type="text/javascript">
        function verifyAnswer() {  
            //get the selected value from the dropdown list  
            var mylist = document.getElementById("sta");  
            var result = mylist.options[mylist.selectedIndex].text;  
                if (result == 'Ya') {  
                    document.getElementById("nam").disabled = false;  
                    document.getElementById("ala").disabled = false;
                    document.getElementById("hub").disabled = false;
                    document.getElementById("tgp").disabled = false;
                    document.getElementById("tgt").disabled = false;
                    document.getElementById("nam2").disabled = false;  
                    document.getElementById("ala2").disabled = false;
                    document.getElementById("hub2").disabled = false;
                    document.getElementById("tgp2").disabled = false;
                    document.getElementById("tgt2").disabled = false;
                } else {  
                    document.getElementById("nam").disabled = true;  
                    document.getElementById("ala").disabled = true;
                    document.getElementById("hub").disabled = true;
                    document.getElementById("tgp").disabled = true;
                    document.getElementById("tgt").disabled = true;  
                    document.getElementById("nam2").disabled = true;  
                    document.getElementById("ala2").disabled = true;
                    document.getElementById("hub2").disabled = true;
                    document.getElementById("tgp2").disabled = true;
                    document.getElementById("tgt2").disabled = true;  
                }  
            } 

            function verifyAnswer2() {  
            //get the selected value from the dropdown list  
            var mylist = document.getElementById("shew");  
            var result = mylist.options[mylist.selectedIndex].text;  
                if (result == 'Ya') {  
                    document.getElementById("anj").disabled = false;  
                    document.getElementById("kuc").disabled = false;
                    document.getElementById("hla").disabled = false;
                } else {  
                    document.getElementById("anj").disabled = true;  
                    document.getElementById("kuc").disabled = true;
                    document.getElementById("hla").disabled = true; 
                }  
            } 

            function verifyAnswer3() {  
            //get the selected value from the dropdown list  
            var mylist = document.getElementById("apd");  
            var result = mylist.options[mylist.selectedIndex].text;  
                if (result == 'Ya') {  
                    document.getElementById("apd1").disabled = false;
                    document.getElementById("apd2").disabled = false;
                    document.getElementById("apd3").disabled = false;
                    document.getElementById("apd4").disabled = false;
                    document.getElementById("apd5").disabled = false;
                    document.getElementById("apd6").disabled = false;
                    document.getElementById("apd7").disabled = false;
                } else {  
                    document.getElementById("apd1").disabled = true;
                    document.getElementById("apd2").disabled = true;
                    document.getElementById("apd3").disabled = true;
                    document.getElementById("apd4").disabled = true;
                    document.getElementById("apd5").disabled = true;
                    document.getElementById("apd6").disabled = true;
                    document.getElementById("apd7").disabled = true;
                }  
            } 
    </script>
  
  

  @endsection