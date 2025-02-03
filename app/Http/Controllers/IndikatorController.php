<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    //dosen dan tendik
    public function indikatorDosenTendik(){
        $indikators = Indikator::select('id','nama_indikator','ditampilkan')->where('category', 1)->get();
        return view('operator/indikator.dosenTendik',[
            'indikators'    => $indikators,
        ]);
    }

    public function postDosenTendik(Request $request){
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ],$attributes);

        Indikator::create([
            'nama_indikator'    =>  $request->nama_indikator,
            'ditampilkan'       =>  1,
            'category'       =>  1,
        ]);

        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.dosen_tendik')->with($notification);
    }



    public function aktifDosenTendik($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 0]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.dosen_tendik')->with($notification);
    }

    public function nonaktifDosenTendik($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 1]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.dosen_tendik')->with($notification);
    }


    //alumni
    public function indikatorAlumni (){
        $indikators = Indikator::select('id','nama_indikator','ditampilkan')->where('category', 2)->get();
        return view('operator/indikator.alumni',[
            'indikators'    => $indikators,
        ]);
    }


    public function postAlumni(Request $request){
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ],$attributes);

        Indikator::create([
            'nama_indikator'    =>  $request->nama_indikator,
            'ditampilkan'       =>  1,
            'category'       =>  2,
        ]);

        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.alumni')->with($notification);
    }



    public function aktifIndikatorAlumni($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 0]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.alumni')->with($notification);
    }

    public function nonaktifIndikatorAlumni($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 1]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.alumni')->with($notification);
    }

    //sarna prasarna
    public function indikatorSaranaPrasarana (){
        $indikators = Indikator::select('id','nama_indikator','ditampilkan')->where('category', 3)->get();
        return view('operator/indikator.sarana_prasarana',[
            'indikators'    => $indikators,
        ]);
    }


    public function postSaranaPrasarana(Request $request){
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ],$attributes);

        Indikator::create([
            'nama_indikator'    =>  $request->nama_indikator,
            'ditampilkan'       =>  1,
            'category'       =>  3,
        ]);

        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.sarana_prasarana')->with($notification);
    }



    public function aktifIndikatorSaranaPrasarana($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 0]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.sarana_prasarana')->with($notification);
    }

    public function nonaktifIndikatorSaranaPrasarana($id){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 1]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.sarana_prasarana')->with($notification);
    }

}
