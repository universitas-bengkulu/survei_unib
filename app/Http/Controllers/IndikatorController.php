<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Indikator;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{

    public function indikator(Request $request)
    {
        $idd = $request->segment(3);
        $id = base64_decode($idd);
        $category_id = substr($id, 8);
        $indikators = Indikator::with(['category.options'])->where('category_id', $category_id)->get();
        $category = Category::where('id', $category_id)->first();
        $options = Option::where('category_id', $category_id)->get();

        return view('operator.indikator.index', [
            'indikators'    => $indikators,
            'category'      => $category,
            'options'       => $options
        ]);
    }

    public function postIndikator(Request $request)
    {
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ], $attributes);

        $cek_auto = Indikator::where('auto', 1)->where('category_id', $request->category_id)->count();

        if ($cek_auto  > 0) {
            $auto_option = 1;
        } else {
            $auto_option = 0;
        }

        $indikator = Indikator::create([
            'nama_indikator'    =>  htmlspecialchars($request->nama_indikator),
            'ditampilkan'       =>  1,
            'category_id'       =>  $request->category_id,
            'auto'              =>  $auto_option,

        ]);

        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $request->slug)->with($notification);
    }

    public function updateIndikator($id, $slug, Request $request)
    {
        $attributes = [
            'nama_indikator'   =>  'Nama Indikator',
        ];
        $this->validate($request, [
            'nama_indikator'    =>  'required',
        ], $attributes);

        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['nama_indikator'    =>  htmlspecialchars($request->nama_indikator)]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }



    public function setOption($id, $slug, Request $request)
    {


        if ($request->scale  == 'skala') {
            $auto_option = 1;
        } else {
            $auto_option = 0;
        }

        $indikators = Indikator::where('category_id', $id)->get();
        foreach ($indikators as $indikator) {
            $indikator->update(['auto' => $auto_option]);
        }

        $cek_auto = Indikator::where('auto', 1)->where('category_id', $request->category_id)->count();

        if ($cek_auto == 0) {

            if ($request->number_input != NULL) {
                if ($request->scale == 'skala') {
                    $type = 'radio';
                    for ($i = 1; $i <= $request->number_input; $i++) {

                        $optionName = 'option' . $i;
                        $optionNilai = 'nilai' . $i;
                        $options[] = array(
                            'category_id' => $id,
                            'nama_option'   => $request->$optionName,
                            'nilai'   => $request->$optionNilai,
                            'type' =>  $type,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        );
                    }
                    Option::insert($options);
                }
            }
        }


        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }

    public function updateOption($id, $slug, Request $request)
    {
        $attributes = [
            'nama_option'   =>  'Nama Option',
            'nilai'   =>  'Nilai Option',
        ];
        $this->validate($request, [
            'nama_option'    =>  'required',
            'nilai'    =>  'required',
        ], $attributes);

        $option = Option::where('id', $id)->first();
        $option->update([
            'nama_option'    =>  htmlspecialchars($request->nama_option),
            'nilai'    =>  htmlspecialchars($request->nilai)
                            ]);
        $notification = array(
            'message' => 'Berhasil, Option berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }

    public function delateOption($id, $slug)
    {
        Option::where('id', $id)->delete();
        $notification = array(
            'message' => 'Berhasil, Option berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }

    public function aktifIndikator($id, $slug)
    {
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 0]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dinonaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }

    public function nonaktifIndikator($id, $slug)
    {
        $indikator = Indikator::where('id', $id)->first();
        $indikator->update(['ditampilkan' => 1]);
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil diaktifkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }

    public function delateIndikator($id, $slug)
    {
        Indikator::where('id', $id)->delete();
        $notification = array(
            'message' => 'Berhasil, indikator penilaian berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('operator.indikator.' . $slug)->with($notification);
    }
}
