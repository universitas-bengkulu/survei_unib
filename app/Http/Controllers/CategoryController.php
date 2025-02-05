<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Formulir;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index (){
        $category = Category::withCount('formulirs')->get();
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

    public function aktif ($id){
        $category = Category::where('id', $id)->first();
        if ($category) {
            $category->update(['default' => 1]);
        } else {
            $notification = array(
                'message' => 'Gagal, Category tidak ditemukan!',
                'alert-type' => 'error'
            );
            return redirect()->route('operator.category')->with($notification);
        }
        $notification = array(
            'message' => 'Berhasil, Category berhasil diaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category')->with($notification);
    }

    public function nonaktif ($id){

        $category = Category::where('id', $id)->first();
        $category->update(['default' => 0]);
        $notification = array(
            'message' => 'Berhasil, category berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category')->with($notification);
    }


    public function formulir ($id){
        $formulir = Formulir::where('category_id',$id)->get();
        $category  = Category::where('id', $id)->first();
        return view('operator.category.formulir',[
            'formulir'      => $formulir,
            'category_id'   => $id,
            'category'   => $category,
        ]);
    }


    public function post_formulir(Request $request){
        $attributes = [
            'label'   =>  'Label formulir',
            'variable'   =>  'Variable formulir',
            'wajib'   =>  'Required formulir',
            'type'   =>  'Type formulir',
        ];
        $this->validate($request, [
            'label'    =>  'required',
            'variable'    =>  'required',
            'wajib'    =>  'required',
            'type'    =>  'required',

        ],$attributes);
        Formulir::create([
            'category_id'    =>  $request->id,
            'label'    =>  htmlspecialchars($request->label),
            'required'    =>  $request->wajib,
            'type'    =>  $request->type,
            'additional'    =>  htmlspecialchars(implode('; ', $request->options)),
            'variable'    =>  htmlspecialchars($request->variable),
        ]);

        $notification = array(
            'message' => 'Berhasil, Formulir berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category.formulir', [$request->id])->with($notification);
    }

    public function update_formulir(Request $request){
        $attributes = [
            'label'   =>  'Label formulir',
            'variable'   =>  'Variable formulir',
            'wajib'   =>  'Required formulir',
        ];
        $this->validate($request, [
            'label'    =>  'required',
            'variable'    =>  'required',
            'wajib'    =>  'required',
        ],$attributes);

        $formulir = Formulir::findOrFail($request->id);
        $formulir->update([
            'label'    =>  htmlspecialchars($request->label),
            'variable'    =>  htmlspecialchars($request->variable),
            'required'    =>  $request->wajib,
        ]);

        $notification = array(
            'message' => 'Berhasil, Formulir berhasil diperbarui!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category.formulir', [$request->category_id])->with($notification);
    }

    public function delate_formulir ($id, $category_id){
        Formulir::where('id',$id)->delete();
        $notification = array(
            'message' => 'Berhasil, Formulir berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.category.formulir', [$category_id])->with($notification);
    }


}
