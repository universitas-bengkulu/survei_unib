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
    <li >laporan Per Indikator</li>
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
@push('styles')
    <style>
        #chartdiv,
        #chartdiv2 {
            width: 100%;
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
                    <h3 class="box-title"><i class="fa fa-book"></i>&nbsp;Manajemen Data Laporan Per Indikator  </h3>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6"><form
                            action="{{ route('evaluasi.export' , [$category->id, $category->slug]) }}"
                            method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            @if($filteredYear)
                                <input type="hidden" name="year" value="{{ $filteredYear }}">
                            @endif

                            <button type="submit" class="btn btn-success  " style="margin-left: 25px; margin-top: 10px;"><i
                                    class="fas fa-file-excel"></i> Export to Excel
                            </button>
                            <a href="#" data-toggle="modal" data-target="#yearFilterModal" class="btn btn-info"
                               style="margin-top: 10px;">
                                <i class="fa fa-filter"></i>
                                Filter Tahun
                            </a>

                        </form></div>
                        <div class="col-md-6 d-flex text-right " style="right: 25px"><!-- Button trigger modal -->
                            <a href="{{ route('evaluasi.download-template' , [$category->id, $category->slug]) }}" class="btn btn-primary">Download Template</a>

                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importModal" >
                                <i class="fa fa-upload"></i> Import
                            </button></div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('evaluasi.import' , [$category->id, $category->slug]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="file">Pilih file untuk diimport</label>
                                            <input type="file" name="file" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-lg-4 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-aqua" style="margin-bottom:0px;">
                            <div class="inner">
                                <h3>{{ count($evaluasiList) }}</h3>

                                <p>Total Responden</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-yellow" style="margin-bottom:0px;">
                            <div class="inner">
                                <h3>{{ number_format(collect($evaluasiList)->avg('total'), 1) }}</h3>

                                <p>Rata-rata Total Skor</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12" style="padding-bottom:10px !important;">
                        <!-- small box -->
                        <div class="small-box bg-green" style="margin-bottom:0px;">
                            <div class="inner">
                                <h3>{{ number_format(collect($evaluasiList)->max('total'), 0) }}</h3>
                                <p>Skor Tertinggi</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">

                        @if($filteredYear)
                            <div class="col-12" style="padding-left: 30px; margin-bottom: 20px;">
                                Tampilkan tahun: <strong>{{ $filteredYear }}</strong>
                            </div>
                        @endif

                        <div class="col-md-12 table-responsive" style="padding:0px 40px">
                            <div class="overflow-x-auto">
                                <table class="table table-hover table-striped table-bordered" id="table">
                                    <thead style="background-color: #3C8DBC; color: white;">
                                    <tr>
                                        <th rowspan="2" style="text-align:center">No</th>
                                        <th rowspan="2" style="text-align:center">Responden</th>
                                        <th style="text-align:center" colspan="{{ $questions->count() }}">Pertanyaan
                                        </th>

                                        <th rowspan="2" style="text-align:center">Total</th>

                                    </tr>
                                    <tr>
                                        @for ($i = 1; $i <= $questions->count(); $i++)
                                            <th> {{ $i }}</th>
                                        @endfor
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($evaluasiList as $evaluasi)
                                        <tr class="hover:bg-gray-50">
                                            <td>{{ $no }}</td>
                                            <td>Responden {{ $no++ }}</td>
                                            @foreach ($questions as $question)
                                                <td class="px-4 py-2 border text-center">
                                                    {{ isset($evaluasi->{$question->id}) ? $evaluasi->{$question->id} : 0 }}
                                                </td>
                                            @endforeach
                                            <td class="px-4 py-2 border font-bold text-center">
                                                {{ $evaluasi->total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('styles')
                <style>
                    .table-container {
                        overflow-x: auto;
                        -webkit-overflow-scrolling: touch;
                    }
                </style>
            @endpush

            @endsection

            @push('scripts')
                <script>
                    $(document).ready(function () {
                        $('#table').DataTable({});
                    });
                </script>
            @endpush

            @section('custom_html')
                <!-- Modal untuk filter tahun -->
                <div class="modal fade" id="yearFilterModal" tabindex="-1" aria-labelledby="yearFilterModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="yearFilterModalLabel">Filter</h5>
                            </div>
                            <form action="{{ route('operator.laporan.per_indikator', [$category->id, $category->slug]) }}" method="get">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="filter-year">Tahun</label>
                                        <select name="year" id="filter-year" class="form-control">
                                            <option value="">Pilih Tahun</option>
                                            @for ($i = 2020; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}" {{ $i == $filteredYear ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <a href="{{ route('operator.laporan.per_indikator', [$category->id, $category->slug]) }}"
                                        class="btn btn-info">Hapus Filter</a>
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
@endsection
