@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
    <i class="fa fa-dashboard">
    </i>&nbsp;DASHBOARD
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
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.setoption.update.' . $category->slug, [$category->id, $category->slug]) }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}

                            <div class=" col-md-12">
                                <label for="">Jenis Jawaban Survei</label>
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <input type="radio" id="pilih1" name="scale" value="skala" required aria-labelledby="pilih1" checked onclick="showNumberInput()">
                                        <label for="pilih1">Opsion skala</label>
                                        <div class="col-md-12" id="number-input-container"  >
                                            <input type="number" id="number-input" name="number_input" min="1" class="form-control" placeholder="Jumlah opsi" oninput="showOptions(this.value)">
                                        </div>
                                    </div>

                                    <script>
                                        function showNumberInput() {
                                            document.getElementById('number-input-container').style.display = 'block';
                                        }
                                    </script>
                                    <div class="col-md-6">
                                        <input type="radio" id="pilih2" name="scale" value="custom" required
                                            aria-labelledby="pilih2" aria-describedby="pilih2" class="disabled" disabled>
                                        <label for="pilih2">Custom</label>
                                    </div>
                                </div>

                                <div style="margin-top: 40px" id="options-container"></div>

                                <script>
                                    function showOptions(scale) {
                                        let container = document.getElementById('options-container');
                                        container.innerHTML = '';
                                        let nilai = scale;
                                        for (let i = 1; i <= scale; i++) {
                                            let option = document.createElement('div');
                                            option.className = 'mb-4';
                                            option.innerHTML = `
                                                <div style="display:flex;gap: 5px;">
                                                    <input type="radio" disabled  >
                                                    <input for="option${i}" placeholder="keterangan option ${i}" name="option${i}" class="form-control" required>
                                                    <input readonly class="readonly col-md-1" name="nilai${i}" value="${nilai--}">
                                                </div>
                                            `;
                                            container.appendChild(option);
                                        }
                                    }
                                </script>
                                <div>
                                    @if ($errors->has('option'))
                                        <small class="form-text text-danger">{{ $errors->first('option') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 text-center" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-check-circle"></i>&nbsp;Set Jawaban</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Indikator <strong
                            class="text-success">{{ $category->nama_category }}</strong></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.indikator.post.' . $category->slug) }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group col-md-12">
                                <label for="">Indikator Penilaian</label>
                                <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}">
                                <input type="hidden" name="slug" id="slug" value="{{ $category->slug }}">
                                <input type="text" name="nama_indikator" id="nama_indikator" class="form-control"
                                    required>
                                <div>
                                    @if ($errors->has('nama_indikator'))
                                        <small class="form-text text-danger">{{ $errors->first('nama_indikator') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 text-center" style="margin-top: 30px;">
                                <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i
                                        class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                                <button type="submit" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fa fa-check-circle"></i>&nbsp;Simpan Indikator</button>
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
                                        <th>Nama Indikator</th>
                                        <th>Ditampilkan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($indikators as $indikator)
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $indikator->nama_indikator }} </td>
                                            <td>
                                                @if ($indikator->ditampilkan == 1)
                                                    <form
                                                        action="{{ route('operator.indikator.aktif.' . $category->slug, [$indikator->id, $category->slug]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <button type="submit" class="btn btn-success btn-sm btn-flat"><i
                                                                class="fa fa-check"></i>&nbsp; Ya</button>
                                                    </form>
                                                @else
                                                    <form
                                                        action="{{ route('operator.indikator.nonaktif.' . $category->slug, [$indikator->id, $category->slug]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <button type="submit" class="btn btn-warning btn-sm btn-flat"><i
                                                                class="fa fa-close"></i>&nbsp;
                                                            Tidak</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td style="display:inline-block !important;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $indikator->id }}">
                                                                <i class="fa fa-edit"></i>&nbsp; Edit
                                                            </button>
                                                        </td>
                                                        <td>

                                                            <form
                                                                action="{{ route('operator.indikator.delete.' . $category->slug, [$indikator->id, $category->slug]) }}"
                                                                method="POST" style="display:inline;">
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
                                        <div class="modal fade" id="editModal{{ $indikator->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel{{ $indikator->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editModalLabel{{ $indikator->id }}">
                                                            <strong>Edit Indikator</strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('operator.indikator.update.' . $category->slug, [$indikator->id, $category->slug]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama_indikator">Nama Indikator</label>
                                                                <input type="text" name="nama_indikator"
                                                                    id="nama_indikator" class="form-control"
                                                                    value="{{ $indikator->nama_indikator }}">
                                                                @if ($errors->has('nama_indikator'))
                                                                    <small
                                                                        class="form-text text-danger">{{ $errors->first('nama_indikator') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Option <strong
                            class="text-success">{{ $category->nama_category }}</strong></h3>
                </div>
                <div class="box-body">
                    <div class="row">


                        <div class="col-md-12 table-responsive">
                            <table class="table table-striped table-bordered" id="table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Option</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($options as $option)
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $option->nama_option }} </td>
                                            <td> {{ $option->nilai }} </td>
                                            <td style="display:inline-block !important;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $option->id }}">
                                                                <i class="fa fa-edit"></i>&nbsp; Edit
                                                            </button>
                                                        </td>
                                                        <td>

                                                            <form
                                                                action="{{ route('operator.option.delete.' . $category->slug, [$option->id, $category->slug]) }}"
                                                                method="POST" style="display:inline;">
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
                                        <div class="modal fade" id="editModal{{ $option->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel{{ $option->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="editModalLabel{{ $option->id }}">
                                                            <strong>Edit option</strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('operator.option.update.' . $category->slug, [$option->id, $category->slug]) }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama_option">Nama option</label>
                                                                <input type="text" name="nama_option"
                                                                    id="nama_option" class="form-control"
                                                                    value="{{ $option->nama_option }}">
                                                                @if ($errors->has('nama_option'))
                                                                    <small
                                                                        class="form-text text-danger">{{ $errors->first('nama_option') }}</small>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nilai">Nilai option</label>
                                                                <input type="number" name="nilai"
                                                                    id="nilai" class="form-control"
                                                                    value="{{ $option->nilai }}">
                                                                @if ($errors->has('nilai'))
                                                                    <small
                                                                        class="form-text text-danger">{{ $errors->first('nilai') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
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
