<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PandaController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\TendikController;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix'  => '/'],function(){
    Route::get('/',[HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dosen-tendik',[HomeController::class, 'dosentendik'])->name('dosen-tendik');
    Route::get('/alumni',[HomeController::class, 'alumni'])->name('alumni');
    Route::get('/sarana-prasarana',[HomeController::class, 'saranaprasarana'])->name('sarana-prasarana');
    Route::post('evaluasi-dosen-tentik/',[HomeController::class, 'postDosenTendik'])->name('evaluasi-dosen-tentik.post');
    Route::post('lulusan/',[HomeController::class, 'postLulusan'])->name('lulusan.post');
    Route::post('sarana-prasarana/',[HomeController::class, 'postSaranaPrasarana'])->name('saranaprasarana.post');
});


Route::get('/operator', function () {
    return redirect()->route('operator.login');
});
Route::group(['prefix'  => 'operator/'],function(){
    Route::get('/login', function () {
        return view('auth/login_operator');
    })->name('operator.login');

    Route::get('/dashboard',[OperatorController::class, 'dashboard'])->name('operator.dashboard');

    //dosen dan tendik
    Route::group(['prefix'  => 'indikator-dosen-tendik/'],function(){
        Route::get('/e',[IndikatorController::class, 'indikatorDosenTendik'])->name('operator.indikator');
        Route::get('/',[IndikatorController::class, 'indikatorDosenTendik'])->name('operator.indikator.dosen_tendik');
        Route::post('/',[IndikatorController::class, 'postDosenTendik'])->name('operator.indikator.post.dosen_tendik');
        Route::delete('/{id}/aktif',[IndikatorController::class, 'aktifDosenTendik'])->name('operator.indikator.aktif.dosen_tendik');
        Route::delete('/{id}/nonaktif',[IndikatorController::class, 'nonaktifDosenTendik'])->name('operator.indikator.nonaktif.dosen_tendik');
    });

    Route::group(['prefix'  => 'laporan-dosen-tendik/'],function(){
        Route::get('/per_prodi',[LaporanController::class, 'perProdi'])->name('operator.laporan.per_prodi');
        Route::get('/pesan_dan_indikator',[LaporanController::class, 'indikator'])->name('operator.laporan.per_indikator');
        Route::get('/pesan_dan_saran',[LaporanController::class, 'saran'])->name('operator.laporan.saran');

        Route::get('evaluasi/export', [LaporanController::class, 'export'])->name('evaluasi.export');
    });


    //alumni
    Route::group(['prefix'  => 'indikator-alumni/'],function(){
        Route::get('/',[IndikatorController::class, 'indikatorAlumni'])->name('operator.indikator.alumni');
        Route::post('/',[IndikatorController::class, 'postAlumni'])->name('operator.indikator.post.alumni');
        Route::delete('/{id}/aktif',[IndikatorController::class, 'aktifIndikatorAlumni'])->name('operator.indikator.aktif.alumni');
        Route::delete('/{id}/nonaktif',[IndikatorController::class, 'nonaktifIndikatorAlumni'])->name('operator.indikator.nonaktif.alumni');
    });

    Route::group(['prefix'  => 'laporan-alumni/'],function(){
        Route::get('/pesan_dan_indikator',[LaporanController::class, 'indikatorAlumni'])->name('operator.laporan.per_indikator.alumni');
        Route::get('/pesan_dan_saran',[LaporanController::class, 'saranAlumni'])->name('operator.laporan.saran.alumni');

        Route::get('evaluasi/export', [LaporanController::class, 'exportAlumni'])->name('evaluasi.export.alumni');
    });


    //sarana prasarana
    Route::group(['prefix'  => 'indikator-sarana-prasarana/'],function(){
        Route::get('/',[IndikatorController::class, 'indikatorSaranaPrasarana'])->name('operator.indikator.sarana_prasarana');
        Route::post('/',[IndikatorController::class, 'postSaranaPrasarana'])->name('operator.indikator.post.sarana_prasarana');
        Route::delete('/{id}/aktif',[IndikatorController::class, 'aktifIndikatorSaranaPrasarana'])->name('operator.indikator.aktif.sarana_prasarana');
        Route::delete('/{id}/nonaktif',[IndikatorController::class, 'nonaktifIndikatorSaranaPrasarana'])->name('operator.indikator.nonaktif.sarana_prasarana');
    });

    Route::group(['prefix'  => 'laporan-sarana-prasarana/'],function(){
        Route::get('/pesan_dan_indikator',[LaporanController::class, 'indikatorSaranaPrasarana'])->name('operator.laporan.per_indikator.sarana_prasarana');
        Route::get('/pesan_dan_saran',[LaporanController::class, 'saranSaranaPrasarana'])->name('operator.laporan.saran.sarana_prasarana');

        Route::get('evaluasi/export', [LaporanController::class, 'exportSaranaPrasarana'])->name('evaluasi.export.sarana_prasarana');
    });

});

Auth::routes();
Route::post('/pandalogin',[PandaController::class, 'pandaLogin'])->name('panda.login');
Route::get('/logout', [PandaController::class, 'authLogout'])->name('authLogout');



Route::group(['prefix'  => 'perencanaan/'],function(){
    Route::get('/login', function () {
        return view('auth/login_perencanaan');
    })->name('perencanaan.login');

    Route::get('/dashboard',[PerencanaanController::class, 'dashboard'])->name('perencanaan.dashboard');
});
