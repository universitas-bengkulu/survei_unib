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

        if (auth()->attempt(array('username'   =>  htmlspecialchars($input['username']), 'password' =>  htmlspecialchars($input['password'])))) {
           if ( Auth::check()) {
            if(auth()->user()->aktif==1){
                if (auth()->user()->akses == "administrator") {
                    $notification1 = array(
                        'message' => 'Berhasil, anda login sebagai administrator!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('operator.dashboard')->with($notification1);
                }elseif (auth()->user()->akses == "operator") {
                    $notification2 = array(
                        'message' => 'Berhasil, anda login sebagai operator!',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('operator.dashboard')->with($notification2);
                }
            }else{
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                    return redirect()->route('login')->with('error','Akun sudah tidak aktif, Silahkan hubungi Admin');
                }
           } else {
                return redirect()->route('login')->with('error','Gagal Login Silahkan Coba lagi');
           }
        }else{
            return redirect()->route('login')->with('error','username atau password salah!');

        }
    }

    public function username()
    {
        return 'username';
    }
}
