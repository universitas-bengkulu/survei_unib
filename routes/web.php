<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeskripsiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PandaController;
use App\Models\Category;
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

Route::group(['prefix'  => '/'], function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');


    Route::get('/{id}/form/{slug}', [HomeController::class, 'home_survei'])->name('survei.home.user');
    Route::post('{id}/post/{slug}', [HomeController::class, 'post_survei'])->name('survei.post');

    Route::get('/dosen-tendik', [HomeController::class, 'dosentendik'])->name('dosen-tendik');
    Route::get('/alumni', [HomeController::class, 'alumni'])->name('alumni');
    Route::get('/sarana-prasarana', [HomeController::class, 'saranaprasarana'])->name('sarana-prasarana');
    Route::post('lulusan/', [HomeController::class, 'postLulusan'])->name('lulusan.post');
    Route::post('sarana-prasarana/', [HomeController::class, 'postSaranaPrasarana'])->name('saranaprasarana.post');
});

Route::get('/operator', function () {
    return redirect()->route('login');
});

Route::group(['prefix'  => 'operator/'], function () {

    Route::get('/dashboard', [OperatorController::class, 'dashboard'])->name('operator.dashboard');
    Route::get('/reset-password', [OperatorController::class, 'reset'])->name('operator.resetPassword');
    Route::post('/reset-pass-user/{id}', [OperatorController::class, 'resetPassUser'])->name('operator.user.resetPasswordUser');
    Route::get('/jenis-survei', [CategoryController::class, 'index'])->name('operator.category');
    Route::post('/post-survei', [CategoryController::class, 'post'])->name('operator.category.post');
    Route::post('/update-survei', [CategoryController::class, 'update'])->name('operator.category.update');
    Route::delete('/{id}/delete/', [CategoryController::class, 'delate'])->name('operator.category.delete');
    Route::post('/{category_id}/aktif', [CategoryController::class, 'aktif'])->name('operator.category.aktif');
    Route::post('/{category_id}/nonaktif', [CategoryController::class, 'nonaktif'])->name('operator.category.nonaktif');

    Route::get('/jenis-survei/{id}/formulir/', [CategoryController::class, 'formulir'])->name('operator.category.formulir');
    Route::post('/post-formulir', [CategoryController::class, 'post_formulir'])->name('operator.category.formulir.post');
    Route::post('/update-formulir', [CategoryController::class, 'update_formulir'])->name('operator.category.formulir.update');
    Route::delete('/{category_id}/delete/{id}/formulir', [CategoryController::class, 'delate_formulir'])->name('operator.category.formulir.delete');

    Route::group(['prefix'  => 'deskripsi/'], function () {
        Route::get('{id}/{slug}/', [DeskripsiController::class, 'deskripsi'])->name('operator.deskripsi');
        Route::post('/{id}/update/{slug}', [DeskripsiController::class, 'updateDeskripsi'])->name('operator.deskripsi.update' );
    });

    Route::group(['prefix'  => 'manajement-operator/'], function () {
        Route::get('/', [OperatorController::class, 'user'])->name('operator.users');
        Route::post('/post', [OperatorController::class, 'post'])->name('operator.post.users' );
        Route::get('/tambah-operator', [OperatorController::class, 'add'])->name('operator.add' );
        Route::get('/{id}/edit-operator', [OperatorController::class, 'edit'])->name('operator.edit' );
        Route::post('/update/{id}', [OperatorController::class, 'update'])->name('operator.update.users' );
        Route::delete('/delate/{id}', [OperatorController::class, 'delate'])->name('operator.delate.users' );
        Route::post('/reset-password/{id}', [OperatorController::class, 'resetPassword'])->name('operator.user.resetPassword' );
    });

    Route::group(['prefix'  => 'indikator'], function ()  {
        Route::get('/{id}/{slug}', [IndikatorController::class, 'indikator'])->name('operator.indikator' );
        Route::post('/', [IndikatorController::class, 'postIndikator'])->name('operator.indikator.post' );
        Route::post('/{id}/update/{slug}', [IndikatorController::class, 'updateIndikator'])->name('operator.indikator.update' );
        Route::post('/{id}/aktif/{slug}', [IndikatorController::class, 'aktifIndikator'])->name('operator.indikator.aktif' );
        Route::post('/{id}/nonaktif/{slug}', [IndikatorController::class, 'nonaktifIndikator'])->name('operator.indikator.nonaktif' );
        Route::delete('/{id}/delete/{slug}', [IndikatorController::class, 'delateIndikator'])->name('operator.indikator.delete' );

        Route::post('/{id}/set-option/{slug}', [IndikatorController::class, 'setOption'])->name('operator.option.post' );
        Route::post('/{id}/option/{slug}', [IndikatorController::class, 'updateOption'])->name('operator.option.update' );
        Route::delete('/{id}/delete/option/{slug}', [IndikatorController::class, 'delateOption'])->name('operator.option.delete' );
    });

    Route::group(['prefix'  => 'laporan/'], function ()  {
        Route::get('/{id}/per_indikator/{slug}', [LaporanController::class, 'laporan_per_indikator'])->name('operator.laporan.per_indikator');
        Route::post('/{id}/export/{slug}', [LaporanController::class, 'export'])->name('evaluasi.export');
        Route::get('/pesan_dan_saran/{id}/{slug}', [LaporanController::class, 'saran'])->name('operator.laporan.saran');
        Route::get('/pesan_dan_saran/{id}/export/{slug}', [LaporanController::class, 'exportSaran'])->name('operator.laporan.saran.export');

        Route::post('/{id}/import/{slug}', [LaporanController::class, 'import'])->name('evaluasi.import');
        Route::get('/{id}/download-template/{slug}', [LaporanController::class, 'generateTemplate'])->name('evaluasi.download-template');
    });




});

Auth::routes();
Route::post('/pandalogin', [PandaController::class, 'pandaLogin'])->name('panda.login');
Route::get('/logout', [PandaController::class, 'authLogout'])->name('authLogout');
