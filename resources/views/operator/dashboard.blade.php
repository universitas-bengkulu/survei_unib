@extends('layouts.operator')
@section('location','Dashboard')
@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;DASHBOARD
@endsection
@section('user-login')
    @if (Auth::check())
        {{ Auth::user()->nm_lengkap }}
    @endif
@endsection
@section('halaman')
    Halaman Operator
@endsection
@section('content-title')
    Dashboard
    <small>Sistem Informasi Survey Kepuasan</small>
@endsection
@section('page')
    <li><a href="#"><i class="fa fa-home"></i> Survei Kepuasan</a></li>
    <li class="active">Dashboard</li>
@endsection
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('user')
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <i class="fa fa-user"></i>&nbsp;
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
        </a>
    </li>
    <li>
        <a href="{{ route('logout') }}" class="btn btn-danger"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>&nbsp; Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endsection
@push('styles')
    <style>
        #chartdiv {
            width: 90%;
            height: 500px;
        }
    </style>
    <style>
        .preloader {    position: fixed;    top: 0;    left: 0;    right: 0;    bottom: 0;    background-color: #ffffff;    z-index: 99999;    height: 100%;    width: 100%;    overflow: hidden !important;}.do-loader{    width: 200px;    height: 200px;    position: absolute;    left: 50%;    top: 50%;    margin: 0 auto;    -webkit-border-radius: 100%;       -moz-border-radius: 100%;         -o-border-radius: 100%;            border-radius: 100%;    background-image: url({{ asset('assets/images/logo.png') }});    background-size: 80% !important;    background-repeat: no-repeat;    background-position: center;    -webkit-background-size: cover;            background-size: cover;    -webkit-transform: translate(-50%,-50%);       -moz-transform: translate(-50%,-50%);        -ms-transform: translate(-50%,-50%);         -o-transform: translate(-50%,-50%);            transform: translate(-50%,-50%);}.do-loader:before {    content: "";    display: block;    position: absolute;    left: -6px;    top: -6px;    height: calc(100% + 12px);    width: calc(100% + 12px);    border-top: 1px solid #07A8D8;    border-left: 1px solid transparent;    border-bottom: 1px solid transparent;    border-right: 1px solid transparent;    border-radius: 100%;    -webkit-animation: spinning 0.750s infinite linear;       -moz-animation: spinning 0.750s infinite linear;         -o-animation: spinning 0.750s infinite linear;            animation: spinning 0.750s infinite linear;}@-webkit-keyframes spinning {   from {-webkit-transform: rotate(0deg);}   to {-webkit-transform: rotate(359deg);}}@-moz-keyframes spinning {   from {-moz-transform: rotate(0deg);}   to {-moz-transform: rotate(359deg);}}@-o-keyframes spinning {   from {-o-transform: rotate(0deg);}   to {-o-transform: rotate(359deg);}}@keyframes spinning {   from {transform: rotate(0deg);}   to {transform: rotate(359deg);}}
    </style>
@endpush
@section('content')
<div class="callout callout-info">
    <h4>Selamat Datang <b>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</b></h4>

    <p>
        Aplikasi Evaluasi adalah aplikasi yang digunakan untuk melakukan proses evaluasi terhadap Lembaga Pengembangan Teknologi Informasi dan Komunikasi (LPTIK) Universitas Bengkulu
        <br>
        <i><b>Catatan</b>: Untuk keamanan, jangan lupa keluar setelah menggunakan aplikasi</i>
    </p>
</div>
<div class="row">
    <div class="col-md-12 sm-6">
        <div class="box box-primary">


            <div class="box-footer">
                <div class="row">
                    @foreach ($evaluasi_per_category as $category_id => $data)
                    <div class="col-md-12  ">
                        <h4 style="background-color: #ccc; color: #000; border-radius: 4px; padding: 5px; font-weight: 800">{{ $categories->find($category_id)->nama_category }}</h4>
                    </div>
                    <div class="col-lg-3 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-aqua" style="margin-bottom:0px;">
                            <div class="inner">
                                <b style="">{{ $data['jumlah_evaluasi'] }}<i> Jumlah Evaluasi</i></b>
                            </div>
                            <div class="icon" style="font-size: 30px; margin-top:10px">
                            <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-blue" style="margin-bottom:0px;">
                            <div class="inner">
                                <b style="">{{ $data['jumlah_evaluasi_today'] }}<i> Evaluasi Hari Ini</i></b>

                            </div>
                            <div class="icon" style="font-size: 30px; margin-top:10px">
                            <i class="fa fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-yellow" style="margin-bottom:0px;">
                            <div class="inner">
                                <b style="">{{ number_format($data['average_skor'], 2) }}<i> Rata-Rata Keseluruhan</i></b>

                            </div>
                            <div class="icon" style="font-size: 30px; margin-top:10px">
                            <i class="fa fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-green" style="margin-bottom:0px;">
                            <div class="inner">
                            <b style="">{{ number_format($data['average_skor_today'], 2) }}<i> Rata-Rata Hari Ini</i></b>

                            </div>
                            <div class="icon" style="font-size: 30px; margin-top:10px">
                            <i class="fa fa-book"></i>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

@endsection


