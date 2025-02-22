@extends('layouts.operator')
@section('location', 'Dashboard')
@section('location2')
    {{ $category->nama_category }}
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
    <li > Form</li>
    <li class="active">{{ $category->nama_category }}</li>
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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Formulir  </h3>
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
                                <span class="text-danger italic">Nama variabel menggunakan huruf kecil tidak menggunakan Angka dan tidak menggunakan SPASI, apabila lebih dari dua huruf gunakan tanda "_"<br> Contoh : nama, usia, no_tlp, nama_sekolah </span>

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
                                <button type="button" class="btn btn-success btn-sm" id="add-option"><i
                                        class="fa fa-plus"></i> Add Option</button>
                                <button type="button" class="btn btn-danger btn-sm" id="delete-option"><i
                                        class="fa fa-minus"></i> Delete Option</button>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const typeInput = document.getElementById('type');
                                    const optionsContainer = document.getElementById('options-container');
                                    const addOptionButton = document.getElementById('add-option');

                                    typeInput.addEventListener('change', function() {
                                        if (this.value === 'radio' || this.value === 'checkbox' || this.value === 'select') {
                                            optionsContainer.style.display = 'block';
                                        } else {
                                            optionsContainer.style.display = 'none';
                                        }
                                    });

                                    addOptionButton.addEventListener('click', function() {
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
                                document.addEventListener('DOMContentLoaded', function() {
                                    const deleteOptionButton = document.getElementById('delete-option');
                                    const optionsContainer = document.getElementById('options-container');

                                    deleteOptionButton.addEventListener('click', function() {
                                        const options = optionsContainer.querySelectorAll('input[name="options[]"]');
                                        if (options.length > 1) {
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
                                        <th>Additional</th>
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
                                                @if ($item->type == 'select')
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
                                            <td>
                                                @if (strpos($item->additional, ';') !== false)
                                                    <ul>
                                                        @foreach (explode(';', $item->additional) as $list)
                                                            <li>{{ $list }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    {{ $item->additional }}
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
                                                            <strong>Ubah Form</strong>
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
                                                            <div class="form-group col-md-12">
                                                                <label for="">Additional</label>
                                                                <textarea name="additional" id="additional" class="form-control" rows="5" style="text-align: left" @if (!in_array($item->type, ['select', 'checkbox', 'radio'])) disabled @endif>{{ $item->additional }}</textarea>
                                                                <span class="text-danger italic">gunakan tanda titik koma <b>;</b> untuk menambah lebih banyak opsi</span>
                                                                <div>
                                                                    @if ($errors->has('wajib'))
                                                                        <small class="form-text text-danger">{{ $errors->first('wajib') }}</small>
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
