<table>
    <thead>
        <tr>
            <td colspan="13" style="background-color:#c5c8c9;text-align: center; border: 1px solid #000000;">DATA PASIEN</td>
        </tr>
        <tr style="border: 1px solid #000000;">
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">NIK</th>
            <th style="width: 30px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">NAMA</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">KECAMATAN</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">KELURAHAN</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">ORANG TUA</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">TGL LAHIR</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">USIA</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">GENDER</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">PEKERJAAN</th>
            <th style="width: 50px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">ALAMAT</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">NO PONSEL</th>
            <th style="width: 20px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">KATEGORI</th>
            <th style="width: 50px; background-color: #5db9e3; border: 1px solid #000000; text-align: center;">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasil as $keg)
        <tr style="border: 1px solid #000000;">
            <td style="border: 1px solid #000000;">{{$keg->NIK}}</td>
            <td style="border: 1px solid #000000;">{{$keg->NAMA}}</td>
            <td style="border: 1px solid #000000;">{{$keg->NAMA_KEC}}</td>
            <td style="border: 1px solid #000000;">{{$keg->KELURAHAN}}</td>
            <td style="border: 1px solid #000000;">{{$keg->NAMA_ORTU}}</td>
            <td style="border: 1px solid #000000;"><?= date('d M Y',strtotime($keg->TGL_LAHIR)); ?></td>
            <td style="border: 1px solid #000000;">{{$keg->UMUR}} Tahun  {{$keg->UMUR}} Bulan</td>
            <td style="border: 1px solid #000000;">{{$keg->GENDER}}</td>
            <td style="border: 1px solid #000000;">{{$keg->PEKERJAAN}}</td>
            <td style="border: 1px solid #000000;">{{$keg->ALAMAT}} RT {{$keg->RT}}/ RW {{$keg->RW}}</td>
            <td style="border: 1px solid #000000;">{{$keg->NO_TELP}}</td>
            <td style="border: 1px solid #000000;">{{$keg->KAT}}</td>
            <td style="border: 1px solid #000000;">{{$keg->KET}}</td>
        </tr>
        @endforeach
    </tbody>    

</table>