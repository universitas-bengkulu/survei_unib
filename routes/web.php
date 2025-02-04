<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PandaController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\TendikController;
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

Route::group(['prefix'  => '/'],function(){
    Route::get('/',[HomeController::class, 'dashboard'])->name('dashboard');

    $categories = Category::all();
    foreach ($categories as $category) {
        Route::get('/'.$category->slug, [HomeController::class, str_replace('-', '', $category->slug)])
            ->name('survei.'.$category->slug);
        Route::post('post-/'.$category->slug,[HomeController::class, 'post_'.str_replace('-', '', $category->slug)])->name($category->slug.'.post');
    }

    Route::get('/dosen-tendik',[HomeController::class, 'dosentendik'])->name('dosen-tendik');
    Route::get('/alumni',[HomeController::class, 'alumni'])->name('alumni');
    Route::get('/sarana-prasarana',[HomeController::class, 'saranaprasarana'])->name('sarana-prasarana');
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
    Route::get('/jenis-survei',[CategoryController::class, 'index'])->name('operator.category');
    Route::post('/post-survei',[CategoryController::class, 'post'])->name('operator.category.post');
    Route::post('/update-survei',[CategoryController::class, 'update'])->name('operator.category.update');
    Route::delete('/{id}/delete/',[CategoryController::class, 'delate'])->name('operator.category.delete');

    $categories = Category::all();
    foreach ($categories as $category) {
        Route::group(['prefix'  => 'indikator-'.$category->slug.'/'],function() use ($category) {
            Route::get('/'.base64_encode(date('Ymd').$category->id),[IndikatorController::class, 'indikator'])->name('operator.indikator.'.$category->slug);
            Route::post('/',[IndikatorController::class, 'postIndikator'])->name('operator.indikator.post.'.$category->slug);
            Route::post('/{id}/aktif/{slug}',[IndikatorController::class, 'aktifIndikator'])->name('operator.indikator.aktif.'.$category->slug);
            Route::post('/{id}/nonaktif/{slug}',[IndikatorController::class, 'nonaktifIndikator'])->name('operator.indikator.nonaktif.'.$category->slug);
            Route::delete('/{id}/delete/{slug}',[IndikatorController::class, 'delateIndikator'])->name('operator.indikator.delete.'.$category->slug);
        });

        Route::group(['prefix'  => 'laporan-'.$category->slug.'/'],function() use ($category) {
            Route::get('/per_indikator/'.base64_encode(date('Ymd').$category->id),[LaporanController::class, 'laporan_per_indikator'])->name('operator.laporan.per_indikator.'.$category->slug);
            Route::post('/{id}/export/{slug}',[LaporanController::class, 'export'])->name('evaluasi.export.'.$category->slug);
            Route::get('/pesan_dan_saran/'.base64_encode(date('Ymd').$category->id),[LaporanController::class, 'saran'])->name('operator.laporan.saran.'.$category->slug);

        });
    }
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
