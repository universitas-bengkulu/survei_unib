@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
Edit Operator
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
    <li class="active">Edit Operator</li>
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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Edit Operator </h3>
                </div>
                <div class="box-body">
                <form action="{{ route('operator.update.users',  [$user->id]) }}" method="POST" class="row">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="nm_lengkap">Nama Lengkap</label>
                        <input type="text" name="nm_lengkap" class="form-control" id="nm_lengkap" value="{{$user->nm_lengkap}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{$user->username}}" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Password <small class="text-success"> (optional)</small></label>
                        <input type="password" name="password" class="form-control" id="password"   >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="unit">Unit</label>
                        <input type="text" name="unit" class="form-control" id="unit" value="{{$user->unit}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="akses">Akses</label>
                        <select name="akses" class="form-control" id="akses" required>
                            <option value="" class="disabled" >-- Pilih Role Akses ---</option>
                            <option value="administrator" {{$user->akses=='administrator'? 'selected': ''}}>Administrator</option>
                            <option value="operator" {{$user->akses=='operator'? 'selected': ''}}>Operator</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="aktif">Aktif</label>
                        <select name="aktif" class="form-control" id="aktif" required>
                            <option value="1" {{$user->aktif=='1'? 'selected': ''}}>Aktif</option>
                            <option value="0" {{$user->aktif=='0'? 'selected': ''}}>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary ">Edit Operator</button>

                    </div>
                </form>

                </div>
            </div>
            </section>
        @endsection
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#table').DataTable({
                        responsive: true,
                    });
                });
            </script>
        @endpush
