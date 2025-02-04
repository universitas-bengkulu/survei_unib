<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index (){
        $category = Category::get();
        return view('operator.category.index',[
            'category'      => $category,
        ]);
    }

    public function post(Request $request){
        $attributes = [
            'nama_category'   =>  'Nama jenis survei',
        ];
        $this->validate($request, [
            'nama_category'    =>  'required',
        ],$attributes);

        Category::create([
            'nama_category'    =>  htmlspecialchars($request->nama_category),
            'slug'       =>  str_replace(' ', '-', strtolower(htmlspecialchars($request->nama_category))),
        ]);

        $notification = array(
            'message' => 'Berhasil, Jenis Survei berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category')->with($notification);
    }

    public function update(Request $request){
        $attributes = [
            'nama_category'   =>  'Nama jenis survei',
        ];
        $this->validate($request, [
            'nama_category'    =>  'required',
        ],$attributes);

        $category = Category::findOrFail($request->id);
        $category->update([
            'nama_category'    =>  htmlspecialchars($request->nama_category),
            'slug'       =>  str_replace(' ', '-', strtolower(htmlspecialchars($request->nama_category))),
        ]);

        $notification = array(
            'message' => 'Berhasil, Jenis Survei berhasil diperbarui!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category')->with($notification);
    }

    public function delate ($id){
        Category::where('id',$id)->delete();
        $notification = array(
            'message' => 'Berhasil, Jenis Survei berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category')->with($notification);
    }
}
