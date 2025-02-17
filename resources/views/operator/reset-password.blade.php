@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
Reset Password
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
    <li class="active">Reset Password</li>
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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Reset Password </h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('operator.user.resetPasswordUser', [auth()->user()->id]) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newPassword{{ auth()->user()->id }}">New Password</label>
                                <input type="password" class="form-control" id="newPassword{{ auth()->user()->id }}" name="new_password" required minlength="8" onkeyup="validatePassword{{ auth()->user()->id }}()">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword{{ auth()->user()->id }}">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword{{ auth()->user()->id }}" name="confirm_password" required minlength="8" onkeyup="validatePassword{{ auth()->user()->id }}()">
                            </div>
                            <script>
                                function validatePassword{{ auth()->user()->id }}() {
                                    var newPassword = document.getElementById('newPassword{{ auth()->user()->id }}').value;
                                    var confirmPassword = document.getElementById('confirmPassword{{ auth()->user()->id }}').value;
                                    if (newPassword !== confirmPassword) {
                                        document.getElementById('confirmPassword{{ auth()->user()->id }}').setCustomValidity('Confirm Password tidak sama.');
                                    } else {
                                        document.getElementById('confirmPassword{{ auth()->user()->id }}').setCustomValidity('');
                                    }
                                }
                            </script>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
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
