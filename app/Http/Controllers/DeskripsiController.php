<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DeskripsiController extends Controller
{
    public function deskripsi (Request $request, $id, $slug){
        $category_id = $id;
        $deskripsi = Category::where('id', $category_id)->first();
        return view('operator.deskripsi.index',[
            'deskripsi'    => $deskripsi,
        ]);
    }

    public function updateDeskripsi($id, $slug, Request $request){
        $attributes = [
            'deskripsi'   =>  'Nama Deskripsi',
        ];
        $this->validate($request, [
            'deskripsi'    =>  'required',
        ],$attributes);

        $indikator = Category::where('id', $id)->first();
        $indikator->update(['deskripsi'    =>  $request->deskripsi]);
        $notification = array(
            'message' => 'Berhasil, Deskripsi berhasi di perbarui!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.deskripsi', [$id, $slug])->with($notification);
    }

}
