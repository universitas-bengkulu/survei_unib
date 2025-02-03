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

    public function dashboard()
    {
        return view('user.home');
    }
    //dosen tendik
    public function dosentendik()
    {
        $indikators = Indikator::where('ditampilkan', true)->where('category', 1)->get();
        return view('user.dosen_tendik', compact('indikators'));
    }

    public function postDosenTendik(Request $request)
    {
        $validated = $request->validate([
            'nilai.*' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18',
            'nama' => 'required',
             'pekerjaan' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nilai.*.required' => 'Nilai harus dipilih untuk setiap indikator',
            'pekerjaan.required' => 'Pekerjaan harus diisi',
        ]);

        try {
            $jumlah = $request->jumlah;

            $data = Indikator::where('ditampilkan', 1)->where('category', 1)->get();

            $kuisioner = array();

            foreach ($data as $item) {
                $nilai = $request->input('nilai' . $item->id);

                $kuisioner[] = array(
                    'nama' => htmlspecialchars($request->nama),
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'indikator_id' => $item->id,
                    'nama_indikator' => $item->nama_indikator,
                    'category' => 1,
                    'skor' => $nilai,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }

            Evaluasi::insert($kuisioner);

            $total = array_sum(array_column($kuisioner, 'skor'));
            $rata = $total / $jumlah;

            EvaluasiRekap::create([
                'nama' => htmlspecialchars($request->nama),
                'category' => 1,
                'pekerjaan' => htmlspecialchars($request->pekerjaan),
                'total_skor' => $total,
                'rata_rata' => $rata,
            ]);

            if (!empty(htmlspecialchars($request->saran))) {
                Saran::create([
                    'nama' => htmlspecialchars($request->nama),
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'category' => 1,
                    'saran' => htmlspecialchars($request->saran),
                ]);
            }

            $notification = array(
                'message' => 'Kuisioner berhasil disimpan!',
                'alert-type' => 'success',
                'titel' => 'Berhasil!'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollback();

            $notification = array(
                'message' => 'Kuisioner gagal disimpan! ' . $e->getMessage(),
                'alert-type' => 'error',
                'titel' => 'Gagal'
            );

            return redirect()->back()->with($notification);
        }
    }

    //alumni
    public function alumni()
    {
        $indikators = Indikator::where('ditampilkan', true)->where('category', 2)->get();
        return view('user.alumni', compact('indikators'));
    }

    public function postLulusan(Request $request)
    {
        $validated = $request->validate([
            'instansi' => 'required',
            'pekerjaan' => 'required',
            'nama' => 'required',
            'pendidikan' => 'required',

        ], [
            'instansi.required' => 'Nama Perusahaan harus diisi',
            'pekerjaan.required' => 'Jabatan harus diisi',
            'nama.required' => 'Nama Alumni Yang Dinilai harus diisi',
            'pendidikan.required' => 'Program Studi Alumni Yang Dinilai harus diisi',

        ]);

        try {
            $jumlah = $request->jumlah;

            $data = Indikator::where('ditampilkan', 1)->where('category', 2)->get();

            $kuisioner = array();

            foreach ($data as $item) {
                $nilai = $request->input('nilai' . $item->id);

                $kuisioner[] = array(
                    'nama' => htmlspecialchars($request->nama),
                    'pendidikan' => htmlspecialchars($request->pendidikan),
                    'pendidikan' => htmlspecialchars($request->instansi),
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'indikator_id' => $item->id,
                    'nama_indikator' => $item->nama_indikator,
                    'category' => 2,
                    'skor' => $nilai,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }

            Evaluasi::insert($kuisioner);

            $total = array_sum(array_column($kuisioner, 'skor'));
            $rata = $total / $jumlah;

            EvaluasiRekap::create([
                'nama' => htmlspecialchars($request->nama),
                'category' => 2,
                'pendidikan' => htmlspecialchars($request->pendidikan),
                'instansi' => htmlspecialchars($request->instansi),
                'pekerjaan' => htmlspecialchars($request->pekerjaan),
                'total_skor' => $total,
                'rata_rata' => $rata,
            ]);

            if (!empty(htmlspecialchars($request->saran))) {
                Saran::create([
                    'nama' => htmlspecialchars($request->nama),
                    'pendidikan' => htmlspecialchars($request->pendidikan),
                    'instansi' => htmlspecialchars($request->instansi),
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'category' => 2,
                    'saran' => htmlspecialchars($request->saran),
                ]);
            }

            $notification = array(
                'message' => 'Kuisioner berhasil disimpan!',
                'alert-type' => 'success',
                'titel' => 'Berhasil!'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollback();

            $notification = array(
                'message' => 'Kuisioner gagal disimpan! ' . $e->getMessage(),
                'alert-type' => 'error',
                'titel' => 'Gagal'
            );

            return redirect()->back()->with($notification);
        }
    }

    //sarana prasarana
    public function saranaprasarana()
    {
        $indikators = Indikator::where('ditampilkan', true)->where('category', 3)->get();
        return view('user.sarana_prasarana', compact('indikators'));
    }

    public function postSaranaPrasarana(Request $request)
    {
        $validated = $request->validate([

            'pekerjaan' => 'required',

        ], [
            'pekerjaan.required' => 'Pengguna Layanan Sarana dan Prasarana harus diisi',

        ]);

        try {
            $jumlah = $request->jumlah;

            $data = Indikator::where('ditampilkan', 1)->where('category', 3)->get();

            $kuisioner = array();

            foreach ($data as $item) {
                $nilai = $request->input('nilai' . $item->id);

                $kuisioner[] = array(
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'indikator_id' => $item->id,
                    'nama_indikator' => $item->nama_indikator,
                    'category' => 3,
                    'skor' => $nilai,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }

            Evaluasi::insert($kuisioner);

            $total = array_sum(array_column($kuisioner, 'skor'));
            $rata = $total / $jumlah;

            EvaluasiRekap::create([
                'pekerjaan' => htmlspecialchars($request->pekerjaan),
                'category' => 3,

                'total_skor' => $total,
                'rata_rata' => $rata,
            ]);

            if (!empty(htmlspecialchars($request->saran))) {
                Saran::create([
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'category' => 3,
                    'saran' => htmlspecialchars($request->saran),
                ]);
            }

            $notification = array(
                'message' => 'Kuisioner berhasil disimpan!',
                'alert-type' => 'success',
                'titel' => 'Berhasil!'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
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
