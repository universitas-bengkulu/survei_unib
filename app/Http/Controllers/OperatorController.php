<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Evaluasi;
use App\Models\EvaluasiRekap;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function dashboard(){
        $jumlah_survei = Category::count();

    $categories = Category::all();
    $evaluasi_per_category = [];

    foreach ($categories as $category) {
        $evaluasi_per_category[$category->id] = [
            'jumlah_evaluasi' => EvaluasiRekap::where('category_id', $category->id)->count(),
            'jumlah_evaluasi_today' => EvaluasiRekap::where('category_id', $category->id)->whereDate('created_at', Carbon::today())->count(),
            'average_skor' => Evaluasi::where('category_id', $category->id)->avg('skor'),
            'average_skor_today' => Evaluasi::where('category_id', $category->id)->whereDate('created_at', Carbon::today())->avg('skor'),
        ];
    }

    return view('operator.dashboard', [
        'jumlah_survei' => $jumlah_survei,
        'evaluasi_per_category' => $evaluasi_per_category,
        'categories' => $categories,
    ]);
    }

    public function user()
    {
        $users = User::get();
        return view('operator.user.index', ['users' => $users]);
    }

    public function add()
    {
        return view('operator.user.tambah' );
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        return view('operator.user.edit', ['user' => $users] );
    }


    public function reset()
    {
        return view('operator.reset-password');
    }

    public function post(Request $request)
    {
        $request->validate([
            'nm_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'aktif' => 'required|boolean',
            'unit' => 'required',
            'akses' => 'required',
        ]);

        User::insert([
            'nm_lengkap' => $request->nm_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'aktif' => $request->aktif,
            'unit' => $request->unit,
            'akses' => $request->akses,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array(
            'message' => 'Berhasil, user berhasil ditambahkan!',
            'alert-type' => 'success'
        );

        return redirect()->route('operator.users')->with($notification);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email' ,
            'aktif' => 'required|boolean',
            'unit' => 'required',
            'akses' => 'required',
        ]);

        $data = [
            'nm_lengkap' => $request->nm_lengkap,
            'email' => $request->email,
            'aktif' => $request->aktif,
            'unit' => $request->unit,
            'akses' => $request->akses,
            'updated_at' => now(),
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        User::where('id', $id)->update($data);

        $notification = array(
            'message' => 'Berhasil, user berhasil diperbarui!',
            'alert-type' => 'success'
        );

        return redirect()->route('operator.users')->with($notification);
    }

    public function delate($id)
    {


        User::where('id', $id)->delete();

        $notification = array(
            'message' => 'Berhasil, user berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->route('operator.users')->with($notification);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:users,id',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'id.required' => 'ID pengguna wajib diisi.',
            'id.integer' => 'ID pengguna harus berupa angka.',
            'id.exists' => 'ID pengguna tidak ditemukan.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal harus terdiri dari 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);




        User::where('id', $request->id)->update([
            'password' => bcrypt($request->new_password),
            'updated_at' => now(),
        ]);

        $notification = array(
            'message' => 'Berhasil, password user berhasil direset!',
            'alert-type' => 'success'
        );

        return redirect()->route('operator.users')->with($notification);
    }

    public function resetPassUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:users,id',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'id.required' => 'ID pengguna wajib diisi.',
            'id.integer' => 'ID pengguna harus berupa angka.',
            'id.exists' => 'ID pengguna tidak ditemukan.',
            'new_password.required' => 'Password baru wajib diisi.',
            'new_password.min' => 'Password baru minimal harus terdiri dari 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);



        $notification = array(
            'message' => 'Berhasil, password user berhasil direset!',
            'alert-type' => 'success'
        );

        User::where('id', $request->id)->update([
            'password' => bcrypt($request->new_password),
            'updated_at' => now(),
        ]);

        $notification = array(
            'message' => 'Berhasil, password user berhasil direset!',
            'alert-type' => 'success'
        );

        return redirect()->route('operator.resetPassword')->with($notification);
    }
}
