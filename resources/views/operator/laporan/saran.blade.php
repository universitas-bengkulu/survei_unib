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
    <li >Informasi Tambahan/saran</li>
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
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>&nbsp;
            Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
@endsection
@push('styles')
    <style>
        #chartdiv, #chartdiv2 {
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
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h3 class="box-title">
                                <i class="fa fa-info-circle"></i>&nbsp;Pesan & Saran
                            </h3>

                            @if($filteredYear)
                                <h5>
                                    Tampilkan Tahun: <strong>{{ $filteredYear }}</strong>
                                </h5>
                            @endif
                        </div>
                        <div class="col-12 col-md-6 text-right">
                            <a href="{{ route('operator.laporan.saran.export', [$category->id, $category->slug, 'year' => $filteredYear]) }}"
                               class="btn btn-primary">
                                Export Excel
                            </a>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                                Filter
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover table-striped" id="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            @foreach ($category->formulirs as $item )
                                <th>{{ $item->label }}</th>
                            @endforeach
                            <th class="bg-info">Pesan / Saran</th>
                            <th>Waktu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no=1;
                        @endphp
                        @forelse ($sarans as $saran)
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($saran->evaluasiRekap->evaluasiDatas as $data)
                                    <td>
                                        @if (strpos($data->isi, ';') !== false)
                                            <ul>
                                                @foreach (explode(';', $data->isi) as $list)
                                                    <li>{{ $list }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            {{ $data->isi }}
                                        @endif

                                    </td>
                                @endforeach
                                <td class="bg-info">{{ $saran->saran ?? '-' }}</td>
                                <td>{{ Carbon\Carbon::parse($saran->created_at)->isoFormat('D MMMM Y') }}</td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('custom_html')
    <!-- Modal untuk filter tahun -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                </div>
                <form action="{{ route('operator.laporan.saran', [$category->id, $category->slug] ) }}" method="get">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="filter-year">Tahun</label>
                            <select name="year" id="filter-year" class="form-control">
                                <option value="">Pilih Tahun</option>
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == $filteredYear ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a href="{{ route('operator.laporan.saran', [$category->id, $category->slug]) }}"
                           class="btn btn-info">Hapus Filter</a>
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({});
        });
    </script>
@endpush
