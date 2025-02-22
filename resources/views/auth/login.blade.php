{{--  <!doctype html>
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
                    <h6>Login Mahasiswa & Dosen</h6>
                    <p style="text-align:center; margin-bottom:20px;">Evaluasi Lembaga Pengembangan Teknologi Informasi dan Komunikasi</p>
                @endif
                <form method="post" action="{{ route('panda.login') }}">
                    @csrf
                    <p>NPM / NIP</p>
                    <input type="text" name="username" placeholder="masukan username">
                    <p>Password Portal Akademik</p>
                    <input type="password" name="password" placeholder="••••••">

                    <button type="submit" name="submit" style="margin-bottom:10px;r"><i class="fa fa-sign-in"></i>&nbsp; Login</button>

                    <a href="{{ route('tendik.login') }}" style="font-weight:200; "><i class="fa fa-arrow-right"></i>&nbsp;Login Sebagai Tendik</a>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src=" {{ asset('assets/particles/particles.min.js') }} "></script>
    <script type="text/javascript" src=" {{ asset('assets/particles/app.js') }} "></script>
    <script>
        // document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
</html>  --}}
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
        <title>Universitas Bengkulu</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/unib.png') }}">
        <link rel="stylesheet" href="{{ asset('assets/lte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href=" {{ asset('css/style_login.css') }} ">
        <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


	</head>
	<body>
		<div id="particles-js">
            <div class="loginBox">
                <img src=" {{ asset('assets/images/unib.png') }} " class="user">
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block" style="font-size:13px;">
                        <strong>Perhatian:</strong> <i>{{ $message }}</i>
                    </div>
                    @else
                    <h6>Login Operator</h6>
                    <p style="text-align:center; margin-bottom:20px;">SURVEY KEPUASAN
                        <br>UNIVERSITAS BENGKULU </p>
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


<!-- jQuery 3 -->
<script src="{{ asset('assets/student/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <script type="text/javascript" src=" {{ asset('assets/particles/particles.min.js') }} "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script type="text/javascript" src=" {{ asset('assets/particles/app.js') }} "></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
            toastr.options = {"closeButton": true,"debug": false,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
            toastr.options = {"closeButton": true,"debug": false,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
            toastr.options = {"closeButton": true,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
            toastr.options = {"closeButton": true,"progressBar": true,"positionClass": "toast-top-right","showDuration": "300","hideDuration": "1000","timeOut": "10000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"};
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif

        $(window).on('load', function(){
            // will first fade out the loading animation
            jQuery(".status").fadeOut();
            // will fade out the whole DIV that covers the website.
            jQuery(".preloader").delay(0).fadeOut("slow");
        });
    </script>
</html>
