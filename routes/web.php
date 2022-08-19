<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', 'Controller@login');
Route::post('/regis', 'Controller@regis');
Route::get('/actlog', 'Controller@actlog');


Route::get('/owner', 'CoOwner@home');
Route::get('/laporan', 'CoOwner@laporan');
Route::get('/flaporan', 'CoOwner@flaporan');

Route::get('/odatalaporanperhari', 'CoOwner@laphari');
Route::get('/odatalaporanperbulan', 'CoOwner@lapbulan');



Route::get('/admin', 'CoAdmin@home');
Route::post('/admin:upd={id}', 'CoAdmin@updadmin');

Route::get('/datapengguna', 'CoAdmin@dtapeng');
Route::post('/add_pengguna', 'CoAdmin@addpeng');
Route::post('/pengguna:upd={id}', 'CoAdmin@updpeng');
Route::get('/pengguna:del={id}', 'CoAdmin@delpeng');

Route::get('/datakota', 'CoAdmin@dtakota');
Route::post('/add_kota', 'CoAdmin@addkota');
Route::post('/kota:upd={id}', 'CoAdmin@updkota');
Route::get('/kota:del={id}', 'CoAdmin@delkota');

Route::get('/datakecamatan', 'CoAdmin@dtakec');
Route::post('/add_kec', 'CoAdmin@addkec');
Route::post('/kec:upd={id}', 'CoAdmin@updkec');
Route::get('/kec:del={id}', 'CoAdmin@delkec');

Route::get('/datakelurahan', 'CoAdmin@dtakel');
Route::post('/add_kel', 'CoAdmin@addkel');
Route::post('/kel:upd={id}', 'CoAdmin@updkel');
Route::get('/kel:del={id}', 'CoAdmin@delkel');

Route::get('/datatempat', 'CoAdmin@dtatmp');
Route::post('/add_tmp', 'CoAdmin@addtmp');
Route::post('/tmp:upd={id}', 'CoAdmin@updtmp');
Route::get('/tmp:del={id}', 'CoAdmin@deltmp');



Route::get('/petugas', 'CoPet@home');
Route::post('/pet:upd={id}', 'CoPet@updpet');

Route::get('/datapasien', 'CoPet@dtapas');
Route::post('/add_pasien', 'CoPet@addpas');
Route::get('/pasien:ed={id}', 'CoPet@edpas');
Route::post('/pasien:upd={id}', 'CoPet@updpas');
Route::get('/pasien:del={id}', 'CoPet@delpas');
Route::get('/cetakpasien', 'CoPet@cetakpas');


Route::get('/pasien:ke={id}', 'CoPet@kerpas');
Route::post('/add_koner', 'CoPet@addkon');
Route::post('/kontak:upd={id}', 'CoPet@updkon');
Route::get('/kontak:del={id}', 'CoPet@delkon');

Route::get('/pasien:kl={id}', 'CoPet@dtakli');
Route::post('/add_klinis', 'CoPet@addkli');
Route::get('/klinis:ed={id}', 'CoPet@edkli');
Route::post('/klinis:upd={id}', 'CoPet@updkli');
Route::get('/klinis:del={id}', 'CoPet@delkli');

Route::get('/pasien:pp={id}', 'CoPet@dtapen');
Route::post('/add_penunjang', 'CoPet@addpp');
Route::post('/pen:upd={id}', 'CoPet@updpp');
Route::get('/pen:del={id}', 'CoPet@delpp');

// Route::get('/pasien:rp={id}', 'CoPet@dtarip');
// Route::post('/add_riper', 'CoPet@addriper');
// Route::get('/riper:det={id}', 'CoPet@detriper');
Route::get('/pasien:rp={id}', 'CoPet@detriper');
Route::get('/riper:del={id}', 'CoPet@delriper');

Route::post('/add_ripera', 'CoPet@addripa');
Route::post('/ripa:upd={id}', 'CoPet@updripa');
Route::get('/ripa:del={id}', 'CoPet@delripa');

Route::post('/add_riperb', 'CoPet@addripb');
Route::post('/ripb:upd={id}', 'CoPet@updripb');
Route::get('/ripb:del={id}', 'CoPet@delripb');

Route::post('/add_riperc', 'CoPet@addripc');
Route::post('/ripc:upd={id}', 'CoPet@updripc');
Route::get('/ripc:del={id}', 'CoPet@delripc');

Route::post('/add_riperd', 'CoPet@addripd');
Route::post('/ripd:upd={id}', 'CoPet@updripd');
Route::get('/ripd:del={id}', 'CoPet@delripd');

Route::get('/pasien:fp={id}', 'CoPet@dtappr');
Route::post('/add_ppr', 'CoPet@addppr');
Route::get('/ppr:det={id}', 'CoPet@detppr');
Route::post('/ppr:upd={id}', 'CoPet@updppr');
Route::get('/ppr:del={id}', 'CoPet@delppr');

Route::post('/add_dppr', 'CoPet@adddppr');
Route::post('/dppr:upd={id}', 'CoPet@upddppr');
Route::get('/dppr:del={id}', 'CoPet@deldppr');

Route::get('/datalaporanperhari', 'CoPet@laphari');
Route::get('/datalaporanperbulan', 'CoPet@lapbulan');


Route::get('/cetaklaporanperhari', 'CoPet@ctklaphari');
Route::get('/cetaklaporanperbulan', 'CoPet@ctklapbulan');




Route::get('/logout', 'Controller@logout');