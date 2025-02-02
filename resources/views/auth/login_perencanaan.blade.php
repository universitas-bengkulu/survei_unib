<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <title>LPTIK Universitas Bengkulu</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
        <link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href=" {{ asset('css/style_login.css') }} ">
        <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="particles-js">
            <div class="loginBox">
                <img src=" {{ asset('assets/images/logo.png') }} " class="user">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block" style="font-size:13px;">
                        <strong>Perhatian:</strong> <i>{{ $message }}</i>
                    </div>
                    @else
                    <h6>Login Perencanaan</h6>
                    <p style="text-align:center; margin-bottom:20px;">Evaluasi Lembaga Pengembangan Teknologi Informasi dan Komunikasi</p>
                @endif
                <form method="post" action="{{ route('login') }}">
                    @csrf
                    <p>Username</p>
                    <input type="text" name="username" placeholder="masukan username">
                    <p>Password</p>
                    <input type="password" name="password" placeholder="••••••">

                    <button type="submit" name="submit" style="margin-bottom:10px;r"><i class="fa fa-sign-in"></i>&nbsp; Login</button>

                    <a href="#" style="font-weight:200; font-style:italic;">Versi 2.0</a>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src=" {{ asset('assets/particles/particles.min.js') }} "></script>
    <script type="text/javascript" src=" {{ asset('assets/particles/app.js') }} "></script>
    <script>
        // document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</html>
