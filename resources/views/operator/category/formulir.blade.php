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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Formulir <strong
                        class="text-success">{{ $category->nama_category }}</strong></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form action="{{ route('operator.category.formulir.post') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <div class="form-group col-md-12">
                                <label for="">Nama Inputan (Label)</label>
                                <input type="hidden" name="id" id="id" value="{{ $category_id }}"
                                    class="form-control">
                                <input type="text" name="label" id="label" class="form-control" required>
                                <div>
                                    @if ($errors->has('label'))
                                        <small class="form-text text-danger">{{ $errors->first('label') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Nama Variable</label>
                                <input type="text" name="variable" id="variable" class="form-control" required>
                                <div>
                                    @if ($errors->has('variable'))
                                        <small class="form-text text-danger">{{ $errors->first('variable') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Wajib Isi (required)</label>
                                <select type="text" name="wajib" id="wajib" class="form-control" required>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                <div>
                                    @if ($errors->has('wajib'))
                                        <small class="form-text text-danger">{{ $errors->first('wajib') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Type Inputan</label>
                                <select type="text" name="type" id="type" class="form-control" required>
                                    <option value="text">Text</option>
                                    <option value="date">Date</option>
                                    <option value="email">Email</option>
                                    <option value="number">Number</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="select">Select</option>
                                </select>
                                <div>
                                    @if ($errors->has('type'))
                                        <small class="form-text text-danger">{{ $errors->first('type') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-12" id="options-container" style="display: none;">
                                <label for="options">Options</label>
                                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 1">
                                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 2">
                                <button type="button" class="btn btn-success btn-sm" id="add-option"><i class="fa fa-plus"></i> Add Option</button>
                                <button type="button" class="btn btn-danger btn-sm" id="delete-option"><i class="fa fa-minus"></i> Delete Option</button>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const typeInput = document.getElementById('type');
                                    const optionsContainer = document.getElementById('options-container');
                                    const addOptionButton = document.getElementById('add-option');

                                    typeInput.addEventListener('change', function () {
                                        if (this.value === 'radio' || this.value === 'checkbox' || this.value === 'select') {
                                            optionsContainer.style.display = 'block';
                                        } else {
                                            optionsContainer.style.display = 'none';
                                        }
                                    });

                                    addOptionButton.addEventListener('click', function () {
                                        const newOption = document.createElement('input');
                                        newOption.type = 'text';
                                        newOption.name = 'options[]';
                                        newOption.className = 'form-control mb-2';
                                        newOption.placeholder = `Option ${optionsContainer.querySelectorAll('input').length + 1}`;
                                        optionsContainer.insertBefore(newOption, addOptionButton);
                                    });
                                });
                            </script>


                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const deleteOptionButton = document.getElementById('delete-option');
                                    const optionsContainer = document.getElementById('options-container');

                                    deleteOptionButton.addEventListener('click', function () {
                                        const options = optionsContainer.querySelectorAll('input[name="options[]"]');
                                        if (options.length > 2) {
                                            optionsContainer.removeChild(options[options.length - 1]);
                                        }
                                    });
                                });
                            </script>

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
                                        <th>Label</th>
                                        <th>Variable</th>
                                        <th>Type</th>
                                        <th>Required</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($formulir as $item)
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $item->label }} </td>
                                            <td> {{ $item->variable }} </td>
                                            <td> {{ $item->type }}
                                                @if ($item->type=='select')
                                                    <select>
                                                        <option>Example</option>
                                                    </select>

                                                @else
                                                    <input type="{{ $item->type }}" value="{{ $item->type }}">
                                                @endif
                                                 </td>
                                            <td>
                                                @if ($item->required == 1)
                                                    <span class="label label-success">Ya</span>
                                                @else
                                                    <span class="label label-danger">Tidak</span>
                                                @endif
                                            </td>
                                            <td style="display:inline-block !important;">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $item->id }}">
                                                                <i class="fa fa-edit"></i>&nbsp; Ubah
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('operator.category.formulir.delete', [$item->id, $category_id]) }}"
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
                                                            <strong>Ubah Jenis Survei</strong>
                                                        </h3>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('operator.category.formulir.update') }}"
                                                        method="POST">
                                                        {{ csrf_field() }} {{ method_field('POST') }}
                                                        <div class="modal-body">
                                                            <div class="form-group col-md-12">
                                                                <label for="">Nama Inputan (Label)</label>
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $item->id }}" class="form-control">
                                                                <input type="hidden" name="category_id" id="category_id"
                                                                    value="{{ $category_id }}" class="form-control">

                                                                <input type="text" value="{{ $item->label }}"
                                                                    name="label" id="label" class="form-control">
                                                                <div>
                                                                    @if ($errors->has('label'))
                                                                        <small
                                                                            class="form-text text-danger">{{ $errors->first('label') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Nama Variable</label>
                                                                <input type="text" value="{{ $item->variable }}"
                                                                    name="variable" id="variable" class="form-control">
                                                                <div>
                                                                    @if ($errors->has('variable'))
                                                                        <small
                                                                            class="form-text text-danger">{{ $errors->first('variable') }}</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="">Wajib Isi (required)</label>
                                                                <select type="text" name="wajib" id="wajib"
                                                                    class="form-control">
                                                                    <option value="1"
                                                                        {{ $item->required == 1 ? 'selected' : '' }}>Ya
                                                                    </option>
                                                                    <option value="0"
                                                                        {{ $item->required == 0 ? 'selected' : '' }}>Tidak
                                                                    </option>
                                                                </select>
                                                                <div>
                                                                    @if ($errors->has('wajib'))
                                                                        <small
                                                                            class="form-text text-danger">{{ $errors->first('wajib') }}</small>
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
