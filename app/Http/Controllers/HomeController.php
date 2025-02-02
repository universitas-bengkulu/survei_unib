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
        $indikators = Indikator::where('ditampilkan',true)->get();
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
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    catch (\Exception $e) {
        DB::rollback();

        $notification = array(
            'message' => 'Kuisioner gagal disimpan! ' . $e->getMessage(),
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }
    }
}
