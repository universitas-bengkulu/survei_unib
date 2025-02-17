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
    Halaman {{auth()->user()->akses}}
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

@section('content')
<div class="callout callout-info">
    <h4>Selamat Datang <b>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</b></h4>

    <p>
        Aplikasi Evaluasi adalah sebuah platform digital yang dirancang untuk mengukur dan mengevaluasi tingkat kepuasan pengguna terhadap layanan akademik, administrasi, serta berbagai kegiatan yang diselenggarakan di Universitas Bengkulu. Aplikasi ini memungkinkan mahasiswa, dosen, dan tenaga kependidikan ataupun masyarakat umum untuk memberikan umpan balik secara sistematis, sehingga dapat menjadi dasar perbaikan dan pengembangan layanan universitas. Dengan fitur yang mudah digunakan, Aplikasi Evaluasi membantu meningkatkan transparansi dan kualitas layanan di lingkungan akademik Universitas Bengkulu.

    </p>
</div>
<div class="row">
    <div class="col-md-12 sm-6">
        <div class="box box-primary">


            <div class="box-footer">
                <div class="row">
                    @foreach ($evaluasi_per_category as $category_id => $data)
                    <div class="col-md-12  ">
                        <h4 style=" color: #000; border-radius: 4px; padding: 5px; font-weight: 800">{{ $categories->find($category_id)->nama_category }}</h4>
                    </div>
                    <div class="col-lg-3 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-aqua" style="margin-bottom:0px;border-radius: 10px;">
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
                        <div class="small-box bg-blue" style="margin-bottom:0px;border-radius: 10px;">
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
                        <div class="small-box bg-yellow" style="margin-bottom:0px;border-radius: 10px;">
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
                        <div class="small-box bg-green" style="margin-bottom:0px;border-radius: 10px;">
                            <div class="inner">
                            <b style="">{{ number_format($data['average_skor_today'], 2) }}<i> Rata-Rata Hari Ini</i></b>

                            </div>
                            <div class="icon" style="font-size: 30px; margin-top:10px">
                            <i class="fa fa-book"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style=" ;margin: 5px">
                        <div style="border-top: 2px solid #3C8DBC;width: 100%;opacity: 20%;"></div>
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


