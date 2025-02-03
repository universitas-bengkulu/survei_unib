<?php

namespace App\Http\Controllers;

use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('isMahasiswa');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        return view('user.home');
    }

    public function dosentendik(){
        $indikators = Indikator::where('ditampilkan',true)->where('category', 1)->get();
        return view('user.dosen_tendik',compact('indikators'));
    }
    public function alumni(){
        $indikators = Indikator::where('ditampilkan',true)->where('category', 2)->get();
        return view('user.alumni',compact('indikators'));
    }
    public function saranaprasarana(){
        $indikators = Indikator::where('ditampilkan',true)->where('category', 3)->get();
        return view('welcome',compact('indikators'));
    }

    public function post(Request $request){
        $validated = $request->validate([
            'nilai.*' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18',
            'nama' => 'required',
            // 'jenis_kelamin' => 'required',
            // 'pendidikan' => 'required',
            'pekerjaan' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nilai.*.required' => 'Nilai harus dipilih untuk setiap indikator',
            // 'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih',
            // 'pendidikan.required' => 'Pendidikan harus diisi',
            'pekerjaan.required' => 'Pekerjaan harus diisi',
        ]);

    try {
        $jumlah = $request->jumlah;

        $data = Indikator::where('ditampilkan', 1)->get();

        $kuisioner = array();

        foreach ($data as $item) {
            $nilai = $request->input('nilai' . $item->id);

            $kuisioner[] = array(
                'nama' => $request->nama,
                // 'jenis_kelamin' => $request->jenis_kelamin,
                // 'usia' => $request->usia,
                // 'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'indikator_id' => $item->id,
                'nama_indikator' => $item->nama_indikator,
                'skor' => $nilai,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
        }

        Evaluasi::insert($kuisioner);

        $total = array_sum(array_column($kuisioner, 'skor'));
        $rata = $total / $jumlah;

        EvaluasiRekap::create([
            'nama' => $request->nama,
            // 'jenis_kelamin' => $request->jenis_kelamin,
            // 'usia' => $request->usia,
            // 'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'total_skor' => $total,
            'rata_rata' => $rata,
        ]);

        if (!empty($request->saran)) {
            Saran::create([
                'nama' => $request->nama,
                // 'jenis_kelamin' => $request->jenis_kelamin,
                // 'usia' => $request->usia,
                // 'pendidikan' => $request->pendidikan,
                'pekerjaan' => $request->pekerjaan,
                'saran' => $request->saran,
            ]);
        }

        $notification = array(
            'message' => 'Kuisioner berhasil disimpan!',
            'alert-type' => 'success',
            'titel' => 'Berhasil!'
        );

        return redirect()->back()->with($notification);
    }
    catch (\Exception $e) {
        DB::rollback();

        $notification = array(
            'message' => 'Kuisioner gagal disimpan! ' . $e->getMessage(),
            'alert-type' => 'error',
            'titel' => 'Gagal'
        );

        return redirect()->back()->with($notification);
    }
    }
}
