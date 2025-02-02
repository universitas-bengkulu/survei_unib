<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use App\Models\Indikator;
use App\Models\Saran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TendikController extends Controller
{
    public function dashboard(){
        $indikators = Indikator::where('ditampilkan',true)->get();
        return view('welcometendik',compact('indikators'));
    }

    public function post(Request $request){
        DB::beginTransaction();
        try {
            $jumlah = $request->jumlah;
            $data = Indikator::where('ditampilkan',1)->get();
            $kuisioner = array();
            foreach ($data as $data) {
                $kuisioner [] =  array(
                    'username'	        =>  $request->username,
                    'nama_lengkap'      =>  $request->nama_lengkap,
                    'akses'             =>  $request->akses,
                    'prodi'             =>  $request->prodi,
                    'fakultas'          =>  $request->fakultas,
                    'indikator_id'	    =>  $data->id,
                    'nama_indikator'	=>  $data->nama_indikator,
                    'skor'              =>  $_POST['nilai'.$data->id],
                    'created_at'        =>  Carbon::now(),
                    'updated_at'        =>  Carbon::now(),
                );
            }

            Evaluasi::insert($kuisioner);
            $total =  array_sum(array_column($kuisioner, 'skor'));
            $rata = $total/$jumlah;
            EvaluasiRekap::create([
                'username'              => $request->username,
                'nama_lengkap'          => $request->nama_lengkap,
                'akses'                 => $request->akses,
                'prodi'                 => $request->prodi,
                'fakultas'              => $request->fakultas,
                'total_skor'            => $total,
                'rata_rata'             => $rata,
            ]);
            if (!$request->saran == null && !$request->saran == "") {
                Saran::create([
                    'username'	        =>  $request->username,
                    'nama_lengkap'      =>  $request->nama_lengkap,
                    'akses'             =>  $request->akses,
                    'prodi'             =>  $request->prodi,
                    'fakultas'          =>  $request->fakultas,
                    'saran'             =>  $request->saran,
                ]);
            }
            DB::commit();
            $notification = array(
                'message' => 'Kuisioner berhasil disimpan!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Kuisioner gagal disimpan!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
