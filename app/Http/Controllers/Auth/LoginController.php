<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $input = $request->all();
        $messages = [
            'required' => ':attribute harus diisi',
            'username' => ':attribute harus berisi username yang valid.',
        ];
        $attributes = [
            'username'    =>  'Username',
            'password'    =>  'Password',
        ];
        $this->validate($request,[
            'username' =>  'required',
            'password' =>  'required',
        ],$messages,$attributes);

        if (auth()->attempt(array('username'   =>  $input['username'], 'password' =>  $input['password'], 'aktif'    =>  true))) {
           if (Auth::check()) {
            if (auth()->user()->akses == "administrator") {
                $notification1 = array(
                    'message' => 'Berhasil, anda login sebagai operator!',
                    'alert-type' => 'success'
                );
                return redirect()->route('operator.dashboard')->with($notification1);;
            }elseif (auth()->user()->akses == "tendik") {
                $notification2 = array(
                    'message' => 'Berhasil, anda login sebagai tenaga kependiidkan!',
                    'alert-type' => 'success'
                );
                return redirect()->route('tendik.dashboard')->with($notification2);
            }elseif (auth()->user()->akses == "perencanaan") {
                $notification2 = array(
                    'message' => 'Berhasil, anda login sebagai perencanaan!',
                    'alert-type' => 'success'
                );
                return redirect()->route('perencanaan.dashboard')->with($notification2);
            }
           } else {
                return redirect()->route('login')->with('error','Password salah atau akun sudah tidak aktif');
           }
        }else{
            $notification = array(
                'message' => 'Gagal, Password salah atau akun sudah tidak aktif, silahkan hubungi admin!',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }
    }

    public function username()
    {
        return 'username';
    }
}
