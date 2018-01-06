<?php

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
//     return view('welcome');
// });




Route::get('/admin/login', ['uses' => 'Auth\AdminLoginController@showLoginForm'])->name('admin.login');

Route::post('/admin/login', ['uses' => 'Auth\AdminLoginController@login'])->name('admin.login.submit');

Route::get('/', ['uses' => 'master_data\DashboardController@indexHome'])->name('admin.dashboard');

Route::get('/akun_pengguna', ['uses' => 'master_data\AkunPenggunaController@indexHome'])->name('admin.akun_pengguna');

Route::post('/akun_pengguna/simpan', ['uses' => 'master_data\AkunPenggunaController@create_akun'])->name('admin.akun_pengguna.simpan');

Route::post('/akun_pengguna/hapus', ['uses' => 'master_data\AkunPenggunaController@softdelete_akun'])->name('admin.akun_pengguna.hapus');

Route::post('/akun_pengguna/update', ['uses' => 'master_data\AkunPenggunaController@update_akun'])->name('admin.akun_pengguna.update');


Route::post('/akun_pengguna/ganti_sandi', ['uses' => 'master_data\AkunPenggunaController@change_password'])->name('admin.akun_pengguna.ganti_sandi');

Route::post('/akun_pengguna/get_user_by_id', ['uses' => 'master_data\AkunPenggunaController@get_user_by_id'])->name('admin.akun_pengguna.get_user_by_id');

Route::get('/informasi_arho', ['uses' => 'master_data\InformasiArhoController@indexHome'])->name('admin.informasi_arho');

Route::post('/informasi_arho/simpan', ['uses' => 'master_data\InformasiArhoController@create_arho'])->name('admin.informasi_arho.simpan');

Route::post('/informasi_arho/update', ['uses' => 'master_data\InformasiArhoController@update_arho'])->name('admin.informasi_arho.update');

Route::post('/informasi_arho/hapus', ['uses' => 'master_data\InformasiArhoController@softdelete_arho'])->name('admin.informasi_arho.hapus');

Route::post('/informasi_arho/get_arho_by_id', ['uses' => 'master_data\InformasiArhoController@get_arho_by_id'])->name('admin.informasi_arho.hapus');

Route::post('/informasi_arho/get_kelurahan_by_kecamatan', ['uses' => 'master_data\InformasiArhoController@get_kelurahan_by_kecamatan'])->name('admin.informasi_arho.get_kelurahan_by_kecamatan');

Route::post('/informasi_arho/simpan_penugasan', ['uses' => 'master_data\InformasiArhoController@create_penugasan_arho'])->name('admin.informasi_arho.simpan_penugasan');

Route::post('/informasi_arho/get_info_penugasan', ['uses' => 'master_data\InformasiArhoController@get_info_penugasan_by_id_kelurahan'])->name('admin.informasi_arho.get_info_penugasan');

Route::post('/arho/fetch_list_arho', ['uses' => 'myapi\ArhoController@fetch_list_arho']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
