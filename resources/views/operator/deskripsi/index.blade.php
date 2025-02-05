@extends('layouts.operator')
@section('location', 'Dashboard')
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
                        document.getElementById('logout-form').submit();"><i
                class="fa fa-sign-out"></i>&nbsp; Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endsection
@push('styles')
<script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>
    <style>
        #chartdiv {
            width: 90%;
            height: 500px;
        }
    </style>
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ffffff;
            z-index: 99999;
            height: 100%;
            width: 100%;
            overflow: hidden !important;
        }

        .do-loader {
            width: 200px;
            height: 200px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin: 0 auto;
            -webkit-border-radius: 100%;
            -moz-border-radius: 100%;
            -o-border-radius: 100%;
            border-radius: 100%;
            background-image: url({{ asset('assets/images/logo.png') }});
            background-size: 80% !important;
            background-repeat: no-repeat;
            background-position: center;
            -webkit-background-size: cover;
            background-size: cover;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .do-loader:before {
            content: "";
            display: block;
            position: absolute;
            left: -6px;
            top: -6px;
            height: calc(100% + 12px);
            width: calc(100% + 12px);
            border-top: 1px solid #07A8D8;
            border-left: 1px solid transparent;
            border-bottom: 1px solid transparent;
            border-right: 1px solid transparent;
            border-radius: 100%;
            -webkit-animation: spinning 0.750s infinite linear;
            -moz-animation: spinning 0.750s infinite linear;
            -o-animation: spinning 0.750s infinite linear;
            animation: spinning 0.750s infinite linear;
        }

        @-webkit-keyframes spinning {
            from {
                -webkit-transform: rotate(0deg);
            }

            to {
                -webkit-transform: rotate(359deg);
            }
        }

        @-moz-keyframes spinning {
            from {
                -moz-transform: rotate(0deg);
            }

            to {
                -moz-transform: rotate(359deg);
            }
        }

        @-o-keyframes spinning {
            from {
                -o-transform: rotate(0deg);
            }

            to {
                -o-transform: rotate(359deg);
            }
        }

        @keyframes spinning {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(359deg);
            }
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Deskripsi <strong class="text-success">{{$deskripsi->nama_category}}</strong> </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.deskripsi.update.'.$deskripsi->slug, [$deskripsi->id, $deskripsi->slug]) }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group col-md-12">
                                <label for="">Deskripsi</label>
                                <input  type="hidden" name="id" value="{{$deskripsi->id}}">
                                <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" rows="3" >{{$deskripsi->deskripsi}}</textarea>
                                <div>
                                    @if ($errors->has('deskripsi'))
                                        <small class="form-text text-danger">{{ $errors->first('deskripsi') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i
                                        class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-check-circle"></i>&nbsp;Simpan</button>
                            </div>
                        </form>
                        <div class="col-md-12">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Berhasil :</strong>{{ $message }}
                                </div>
                            @elseif ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Gagal :</strong>{{ $message }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </section>
        @endsection
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        @push('scripts')
            <script>
                CKEDITOR.replace( 'deskripsi' );
            </script>
        @endpush
