<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Evaluasi;
use App\Models\EvaluasiData;
use App\Models\EvaluasiRekap;
use App\Models\Formulir;
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

    //default
    public function home_survei(Request $request)
    {
        $idd = $request->segment(1);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $categories = Category::where('id', $category_id)->first();
        $formulir = Formulir::where('category_id', $category_id)->get();
        $indikators = Indikator::where('ditampilkan', true)->where('category_id', $category_id)->get();
        return view('user.home_survei', compact(['indikators', 'categories', 'formulir']));
    }
    public function post_survei(Request $request)
    {

        $formulir = Formulir::where('category_id', $request->category_id)->get();
        $rules = [];
        $messages = [];
        foreach ($formulir as $item) {
            if($item->required == 1){
                $rules[$item->variable] = 'required';
                $messages[$item->variable . '.required'] = $item->label . ' harus diisi';
            }

        }
        $validated = $request->validate($rules, $messages);
        try {
            $jumlah = $request->jumlah;
            $data = Indikator::where('ditampilkan', 1)->where('category_id', $request->category_id)->get();
            $last_id = EvaluasiRekap::max('id') + 1;
            EvaluasiRekap::create([
                'category_id' => $request->category_id,
            ]);

            foreach ($data as $item) {
                $nilai = $request->input('nilai_' . $item->id);
                $kuisioner[] = array(
                    'evaluasi_rekap_id' => $last_id,
                    'indikator_id' => $item->id,
                    'nama_indikator' => htmlspecialchars($item->nama_indikator),
                    'category_id' => $request->category_id,
                    'skor' => $nilai,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }
            Evaluasi::insert($kuisioner);



            foreach ($formulir as $item) {
                if($item->variable == 'checkbox'){
                    $isi = implode('; ', $request->options);
                }
                else {
                    $input = $request->input($item->variable);
                    $isi = is_array($input) ? implode('; ', $input) : htmlspecialchars($input);
                }
                $data_user[] = array(
                    'evaluasi_rekap_id' => $last_id,
                    'variable'   => htmlspecialchars($item->variable),
                    'isi' =>  $isi,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }
            EvaluasiData::insert($data_user);
            if (!empty(htmlspecialchars($request->saran))) {
                Saran::create([
                    'evaluasi_rekap_id' => $last_id,
                    'category_id' => $request->category_id,
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

    public function surveikerjasama (){
        return view('user.custom.kerja_sama');
    }


}
