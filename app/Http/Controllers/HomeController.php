<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::get();
        return view('user.home', compact('categories'));
    }


    //surveilayananmanajemen (2)
        public function surveilayananmanajemen()
        {
            $indikators = Indikator::where('ditampilkan', true)->where('category_id', 2)->get();
            $categories = Category::where('id', 2)->first();
            return view('user.layanan-manajemen', compact(['indikators', 'categories']));
        }
        public function post_surveilayananmanajemen(Request $request)
        {
            $validated = $request->validate([
                // 'nilai.*' => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18',
                // 'nama' => 'required',
                'pekerjaan' => 'required',
            ], [
                // 'nama.required' => 'Nama harus diisi',
                // 'nilai.*.required' => 'Nilai harus dipilih untuk setiap indikator',
                'pekerjaan.required' => 'Pekerjaan harus diisi',
            ]);
            try {
                $jumlah = $request->jumlah;
                $data = Indikator::where('ditampilkan', 1)->where('category_id', 2)->get();
                $last_id =EvaluasiRekap::max('id')+1;
                $kuisioner = array();
                foreach ($data as $item) {
                    $nilai = $request->input('nilai' . $item->id);
                    $kuisioner[] = array(
                        // 'nama' => htmlspecialchars($request->nama),
                        'nama' => 'user'.$last_id,
                        'pekerjaan' => htmlspecialchars($request->pekerjaan),
                        'indikator_id' => $item->id,
                        'nama_indikator' => $item->nama_indikator,
                        'category_id' => 2,
                        'skor' => $nilai,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    );
                }
                Evaluasi::insert($kuisioner);
                $total = array_sum(array_column($kuisioner, 'skor'));
                $rata = $total / $jumlah;
                EvaluasiRekap::create([
                    // 'nama' => htmlspecialchars($request->nama),
                    'nama' => 'user'.$last_id,
                    'category_id' => 2,
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'total_skor' => $total,
                    'rata_rata' => $rata,
                ]);
                if (!empty(htmlspecialchars($request->saran))) {
                    Saran::create([
                        // 'nama' => htmlspecialchars($request->nama),
                        'nama' => 'user'.$last_id,
                        'pekerjaan' => htmlspecialchars($request->pekerjaan),
                        'category_id' => 2,
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
        $indikators = Indikator::where('ditampilkan', true)->where('category_id', 2)->get();
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
            $data = Indikator::where('ditampilkan', 1)->where('category_id', 2)->get();
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
                    'category_id' => 2,
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
                'category_id' => 2,
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
                    'category_id' => 2,
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
        $indikators = Indikator::where('ditampilkan', true)->where('category_id', 3)->get();
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
            $data = Indikator::where('ditampilkan', 1)->where('category_id', 3)->get();
            $kuisioner = array();
            foreach ($data as $item) {
                $nilai = $request->input('nilai' . $item->id);
                $kuisioner[] = array(
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'indikator_id' => $item->id,
                    'nama_indikator' => $item->nama_indikator,
                    'category_id' => 3,
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
                'category_id' => 3,
                'total_skor' => $total,
                'rata_rata' => $rata,
            ]);
            if (!empty(htmlspecialchars($request->saran))) {
                Saran::create([
                    'pekerjaan' => htmlspecialchars($request->pekerjaan),
                    'category_id' => 3,
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
