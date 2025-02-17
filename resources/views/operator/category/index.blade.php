@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
Jenis Survei
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
    <li class="active">Jenis Survei</li>
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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Jenis Survei </h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.category.post') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group col-md-12">
                                <label for="">Nama Jenis Survei</label>
                                <input type="text" name="nama_category" id="nama_category" class="form-control">
                                <div>
                                    @if ($errors->has('nama_category'))
                                        <small class="form-text text-danger">{{ $errors->first('nama_category') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i
                                        class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-check-circle"></i>&nbsp;Simpan Jenis Survei</button>
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
                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped table-bordered" id="table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jenis Survei</th>
                                        <th>Slug</th>
                                        {{-- <th>Custom Page</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($category as $item)
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $item->nama_category }} </td>
                                            <td> {{ $item->slug }} </td>
                                            {{-- <td style="display:inline-block !important;text-align:center;">


                                                @if ($item->default == 0)
                                                    <form action="{{ route('operator.category.aktif', [$item->id]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <button type="submit" class="btn btn-warning btn-sm btn-flat"><i
                                                                class="fa fa-thumbs-down"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('operator.category.nonaktif', [$item->id]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <button type="submit" class="btn btn-success btn-sm btn-flat"><i
                                                                class="fa fa-thumbs-up"></i></button>
                                                    </form>
                                                @endif

                                                <label class="label label-info">ID : {{ $item->id }}</label>
                                            </td> --}}
                                            <td style="display:inline-block !important;">
                                                <table>
                                                    <tr>
                                                        {{-- <td>
                                                            <a href="{{ route('operator.category.formulir', [$item->id]) }}"
                                                                class="btn btn-info btn-sm btn-flat">
                                                                <i class="fa fa-folder"></i>&nbsp; Form
                                                                ({{ $item->formulirs_count }})
                                                            </a>
                                                        </td> --}}
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $item->id }}">
                                                                <i class="fa fa-edit"></i>&nbsp; Ubah
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('operator.category.delete', [$item->id]) }}"
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

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editModalLabel{{ $item->id }}">
                                                            <strong>Ubah Jenis Survei</strong></h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('operator.category.update') }}" method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama_category">Nama Jenis Survei</label>
                                                                <input type="text" name="nama_category"
                                                                    id="nama_category" class="form-control"
                                                                    value="{{ $item->nama_category }}">
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $item->id }}">
                                                                <div>
                                                                    @if ($errors->has('nama_category'))
                                                                        <small
                                                                            class="form-text text-danger">{{ $errors->first('nama_category') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
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
