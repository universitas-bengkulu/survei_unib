<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Indikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{

    public function indikator (Request $request){
        $idd = $request->segment(3);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $indikators = Indikator::select('id','nama_indikator','ditampilkan')->where('category_id', $category_id)->get();
        $category = Category::where('id', $category_id)->first();
        return view('operator.indikator.index',[
            'indikators'    => $indikators,
            'category'      => $category,
        ]);
    }

    public function postIndikator(Request $request){
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ],$attributes);

        Indikator::create([
            'nama_indikator'    =>  htmlspecialchars($request->nama_indikator),
            'ditampilkan'       =>  1,
            'category_id'       =>  $request->category_id,
        ]);

        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.'.$request->slug)->with($notification);
    }

    public function updateIndikator($id, $slug, Request $request){
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ],$attributes);

        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['nama_indikator'    =>  htmlspecialchars($request->nama_indikator)]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.'.$slug)->with($notification);
    }

    public function aktifIndikator($id, $slug){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 0]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.'.$slug)->with($notification);
    }

    public function nonaktifIndikator($id, $slug){
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 1]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil diaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.'.$slug)->with($notification);
    }

    public function delateIndikator ($id, $slug){
        Indikator::where('id',$id)->delete();
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.'.$slug)->with($notification);
    }




}
