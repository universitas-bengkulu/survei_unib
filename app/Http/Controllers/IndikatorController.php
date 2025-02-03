<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function index(){
        $indikators = Indikator::select('id','nama_indikator','ditampilkan')->get();
        return view('operator/indikator.index',[
            'indikators'    => $indikators,
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ],$attributes);

        Indikator::create([
            'nama_indikator'    =>  $request->nama_indikator,
            'ditampilkan'       =>  1,
        ]);

        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator')->with($notification);
    }



    public function aktif($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 0]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator')->with($notification);
    }

    public function nonaktif($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 1]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator')->with($notification);
    }
}
