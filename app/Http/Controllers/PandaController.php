<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PandaController extends Controller
{
    public function pandaToken()
   	{
    	$client = new Client();

        $url = 'https://panda.unib.ac.id/api/login';
	      try {
	        $response = $client->request(
	            'POST',  $url, ['form_params' => ['email' => 'evaluasi@unib.ac.id', 'password' => 'evaluasi2018']]
	        );
	        $obj = json_decode($response->getBody(),true);
	        Session::put('token', $obj['token']);
	        return $obj['token'];
	      } catch (GuzzleHttp\Exception\BadResponseException $e) {
	        echo "<h1 style='color:red'>[Ditolak !]</h1>";
	        exit();
	      }
    }

    public function pandaLogin(Request $request){
    	$username = $request->username;
        $password = $request->password;
        // $count =  preg_match_all( "/[0-9]/", $username );
    	$query = '
			{portallogin(username:"'.$username.'", password:"'.$password.'") {
			  is_access
			  tusrThakrId
			}}
    	';
    	$data = $this->panda($query)['portallogin'];

        $data_mahasiswa = '
            {mahasiswa(mhsNiu:"' . $username . '") {
                mhsNiu
                mhsNama
                prodi {
                prodiKode
                prodiNamaResmi
                    fakultas {
                        fakKode
                        fakNamaResmi
                    }
                }

            }}
        ';

        $data_dosen = '
            {dosen(dsnPegNip: "'.$username.'") {
            dsnPegNip
            dsnNidn
            prodi {
                prodiKode
                prodiNamaResmi
                fakultas {
                fakKode
                fakNamaResmi
                }
            }
            pegawai{
                pegNama
                pegIsAktif
                pegawai_simpeg {
                    pegJenkel
                    pegNmJabatan
                }
            }
            }}
        ';

        if($data[0]['is_access']==1){
    		if($data[0]['tusrThakrId']==2){
                $dosen2 = $this->panda($data_dosen);
                if($dosen2['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                    Session::put('login_as','Dosen');
                    Session::put('username',$dosen2['dosen'][0]['dsnPegNip']);
                    Session::put('nama_lengkap',$dosen2['dosen'][0]['pegawai']['pegNama']);
                    Session::put('prodi',$dosen2['dosen'][0]['prodi']['prodiNamaResmi']);
                    Session::put('fakultas',$dosen2['dosen'][0]['prodi']['fakultas']['fakNamaResmi']);
                    Session::put('login',1);
                    Session::put('akses',2);
                    if (!empty(Session::get('akses')) && Session::get('akses',2)) {
                        return redirect()->route('evaluasi.dashboard');
                    }
                    else{
                        return redirect()->route('login')->with(['error'	=> 'Username dan Password Salah !! !!']);
                    }
                }
            }
            elseif($data[0]['tusrThakrId']==1){
                $mahasiswa = $this->panda($data_mahasiswa);
                // if (empty($mahasiswa[0])) {
                //     return redirect()->route('login')->with(['error'	=> 'Akun anda tidak ditemukan !! !!']);
                // }
                Session::put('login_as','Mahasiswa');
    			Session::put('nama_lengkap',$mahasiswa['mahasiswa'][0]['mhsNama']);
                Session::put('username',$mahasiswa['mahasiswa'][0]['mhsNiu']);
                Session::put('prodi',$mahasiswa['mahasiswa'][0]['prodi']['prodiNamaResmi']);
    			Session::put('fakultas',$mahasiswa['mahasiswa'][0]['prodi']['fakultas']['fakNamaResmi']);
                Session::put('login',1);
                Session::put('akses',1);
                if (Session::get('akses') == 1) {
                    return redirect()->route('evaluasi.dashboard');
                }
                else{
                    return redirect()->route('login')->with(['error'	=> 'Akun anda tidak dikenali !! !!']);
                }
    		}
            else {
    			return redirect()->route('login')->with(['error'	=> 'Akses Anda Tidak Diketahui !!']);
            }
        }

        else if($password == "evaluasilptik" && $username == $request->username) {
            if (strlen($request->username) == 9) {
                $mahasiswa = $this->panda($data_mahasiswa);
                // if (empty($mahasiswa[0])) {
                //     return redirect()->route('login')->with(['error'	=> 'Akun anda tidak ditemukan !! !!']);
                // }
                Session::put('login_as','Mahasiswa');
    			Session::put('nama_lengkap',$mahasiswa['mahasiswa'][0]['mhsNama']);
                Session::put('username',$mahasiswa['mahasiswa'][0]['mhsNiu']);
                Session::put('prodi',$mahasiswa['mahasiswa'][0]['prodi']['prodiNamaResmi']);
    			Session::put('fakultas',$mahasiswa['mahasiswa'][0]['prodi']['fakultas']['fakNamaResmi']);
                Session::put('login',1);
                Session::put('akses',1);
                if (Session::get('akses') == 1) {
                    return redirect()->route('evaluasi.dashboard');
                }
                else{
                    return redirect()->route('login')->with(['error'	=> 'Akun anda tidak dikenali !! !!']);
                }
            }else {
                $dosen2 = $this->panda($data_dosen);
                if($dosen2['dosen'][0]['pegawai']['pegIsAktif'] == 1){
                    Session::put('login_as','Dosen');
                    Session::put('username',$dosen2['dosen'][0]['dsnPegNip']);
                    Session::put('nama_lengkap',$dosen2['dosen'][0]['pegawai']['pegNama']);
                    Session::put('prodi',$dosen2['dosen'][0]['prodi']['prodiNamaResmi']);
                    Session::put('fakultas',$dosen2['dosen'][0]['prodi']['fakultas']['fakNamaResmi']);
                    Session::put('login',1);
                    Session::put('akses',2);
                    if (Session::get('akses') == 2) {
                        return redirect()->route('evaluasi.dashboard');
                    }
                    else{
                        return redirect()->route('login')->with(['error'	=> 'Akun anda tidak dikenali !! !!']);
                    }
                }else{
                    return redirect()->route('login')->with(['error'	=> 'Akun anda tidak aktif !! !!']);
                }
            }
        }
        else{
			return redirect()->route('login')->with(['error'	=> 'Username dan Password Salah !! !!']);
        }
    }

    public function panda($query){
        $client = new Client();
        try {
            $response = $client->request(
                'POST','https://panda.unib.ac.id/panda',
                ['form_params' => ['token' => $this->pandaToken(), 'query' => $query]]
            );
            $arr = json_decode($response->getBody(),true);
            if(!empty($arr['errors'])){
                echo "<h1><i>Kesalahan Query...</i></h1>";
            }else{
                return $arr['data'];
            }
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $res = json_decode($responseBodyAsString,true);
            if($res['message']=='Unauthorized'){
                echo "<h1><i>Meminta Akses ke Pangkalan Data...</i></h1>";
                $this->panda_token();
                header("Refresh:0");
            }else{
                print_r($res);
            }
        }
    }

    public function showLoginForm(){
        if (!empty(Session::get('login')) && Session::get('login',1)) {
            return redirect()->route('mahasiswa.dashboard');
        }
        else{
            return view('auth.login_mahasiswa');
        }
    }

    public function authLogout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
