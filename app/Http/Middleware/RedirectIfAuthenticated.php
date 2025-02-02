<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
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
                } else {
                        return redirect()->route('login')->with('error','Password salah atau akun sudah tidak aktif');
                }
            }
        }
        return $next($request);
    }
}
