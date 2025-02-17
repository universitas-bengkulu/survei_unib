@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
     {{ $deskripsi->nama_category }}
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
    <li >Deskripsi</li>
    <li class="active">{{ $deskripsi->nama_category }}</li>
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

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Deskripsi   </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.deskripsi.update', [$deskripsi->id, $deskripsi->slug]) }}" method="POST">
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
        <script src="{{ asset('assets/ckeditor/ckeditor.js')}}"></script>
        @push('scripts')
            <script>
                CKEDITOR.replace( 'deskripsi' );
            </script>
        @endpush
