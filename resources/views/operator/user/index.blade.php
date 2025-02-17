@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
Manajemen Operator
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
    <li class="active">Users</li>
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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Operator </h3>
                    <div class="box-tools pull-right">
                        <a  href="{{route('operator.add')}}" class="btn btn-primary btn-sm btn-flat"  >
                            <i class="fa fa-plus"></i>&nbsp; Tambah User
                        </a>
                    </div>
                </div>


                <div class="box-body">
                    <div class="row">
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
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped table-bordered" id="table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Unit</th>
                                        <th>Akses</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($users as $item)
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $item->nm_lengkap }} </td>
                                            <td> {{ $item->username }} </td>
                                            <td> {{ $item->email }} </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#resetPasswordModal{{ $item->id }}">
                                                    Reset Password
                                                </button>

                                            </td></td>
                                            <td> {{ $item->unit }} </td>
                                            <td> {{ $item->akses }} </td>
                                            <td style="display:inline-block !important;text-align:center;">


                                                @if ($item->aktif == 0)
                                                <label for="" class="label label-warning">Tidak Aktif</label>

                                                @else
                                                <label for="" class="label label-success"> Aktif</label>


                                                @endif
                                            </td>
                                            <td style="display:inline-block !important;">
                                                <table>
                                                    <tr>

                                                        <td>
                                                            <a href="{{route('operator.edit', [$item->id])}}" class="btn btn-warning btn-sm btn-flat" >
                                                                <i class="fa fa-edit"></i>&nbsp; Ubah
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('operator.delate.users', [$item->id]) }}"
                                                                method="POST">
                                                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm btn-flat"><i
                                                                        class="fa fa-trash"></i>&nbsp; Hapus</button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="resetPasswordModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="resetPasswordModalLabel{{ $item->id }}">Reset Password</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('operator.user.resetPassword', [$item->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="newPassword{{ $item->id }}">New Password</label>
                                                                <input type="password" class="form-control" id="newPassword{{ $item->id }}" name="new_password" required minlength="8" onkeyup="validatePassword{{ $item->id }}()">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="confirmPassword{{ $item->id }}">Confirm Password</label>
                                                                <input type="password" class="form-control" id="confirmPassword{{ $item->id }}" name="confirm_password" required minlength="8" onkeyup="validatePassword{{ $item->id }}()">
                                                            </div>
                                                            <script>
                                                                function validatePassword{{ $item->id }}() {
                                                                    var newPassword = document.getElementById('newPassword{{ $item->id }}').value;
                                                                    var confirmPassword = document.getElementById('confirmPassword{{ $item->id }}').value;
                                                                    if (newPassword !== confirmPassword) {
                                                                        document.getElementById('confirmPassword{{ $item->id }}').setCustomValidity('Confirm Password tidak sama.');
                                                                    } else {
                                                                        document.getElementById('confirmPassword{{ $item->id }}').setCustomValidity('');
                                                                    }
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
