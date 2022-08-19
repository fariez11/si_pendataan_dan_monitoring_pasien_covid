<?php 
    
    $ka1a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");
    $ka1b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");
    $ka1c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Isolasi' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");
    $ka1d= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Suspek' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");


    $ka2a= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");
    $ka2b= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Terkena Gejala' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");
    $ka2c= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.STATUS = 'Tanpa Gejala' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");
    $ka2d= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");


    $ka2g= DB::SELECT("SELECT COUNT( DISTINCT a.NIK) as jum FROM pasien a, klinis b, r_perj1 c WHERE a.NIK = b.NIK AND b.NIK = c.NIK AND a.KAT = 'Kasus Konfirmasi' AND b.ST_PASIEN = 'Sembuh' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");


    $ka3f= DB::SELECT("SELECT count(*)as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kontak Erat' AND ST_PASIEN = 'Discarder' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");



    $ka4b= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b WHERE a.NIK = b.NIK AND a.KAT = 'Kasus Probabel' AND b.ST_PASIEN = 'Meninggal' AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");



    $ka5a= DB::SELECT("SELECT COUNT(DISTINCT a.NIK) as jum FROM pasien a, klinis b, p_penunjang c WHERE a.NIK = b.NIK AND a.NIK = c.NIK AND b.TGL_RELEASE BETWEEN '$ta' AND '$tb' ");

?>
<table border="" style="width: 100%;">
    <tr style="background-color:#c5c8c9;text-align: center;font-weight: bold;">
        <td style="padding: 10px;text-align: center;background-color:#aeb0b0;"><b>No</b></td>
        <td colspan="3" style="width: 50px;text-align: center;background-color:#aeb0b0;"><b>STATUS</b></td>
        <td style="text-align: center;background-color:#aeb0b0;width: 30px;"><b>JUMLAH PER HARI</b></td>
    </tr>
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>1</b></td>
        <td style="background-color:#c5c8c9;"colspan="4"><b>DATA KASUS SUSPEK</b></td>
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
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>2</b></td>
        <td style="background-color:#c5c8c9;" colspan="4"><b>DATA KASUS KONFIRMASI</b></td>
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
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>3</b></td>
        <td style="background-color:#c5c8c9;" colspan="4"><b>DATA PEMANTAUAN KONTAK ERAT</b></td>
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
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>4</b></td>
        <td style="background-color:#c5c8c9;" colspan="4"><b>DATA KASUS MENINGGAL</b></td>
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
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>5</b></td>
        <td style="background-color:#c5c8c9;" colspan="4"><b>PEMERIKSAAN RT-PCR</b></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">Jumlah kasus diambil specimen/swab</td>
        <td style="text-align: center;">@foreach($ka5a as $ka5a) {{$ka5a->jum}} orang @endforeach</td>
    </tr>
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>6</b></td>
        <td style="background-color:#c5c8c9;" colspan="4"><b>SURVEILANS SEROLOGI</b></td>
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
    <tr>
        <td style="text-align: center;background-color:#c5c8c9;"><b>7</b></td>
        <td style="background-color:#c5c8c9;" colspan="4"><b>ISOLASI / KARANTINA HARI INI</b></td>
    </tr>
    <tr style="text-align: center;">
        <td></td>
        <td style="padding:10px;text-align: center;">KLASIFIKASI</td>
        <td style="width:15px;text-align: center;">RS.RUJUKAN</td>
        <td style="width:15px;text-align: center;">RS.DARURAT</td>
        <td style="text-align: center;">ISOLASI / KARANTINA MANDIRI</td>
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