@extends('layouts.layout')
@section('login')

@endsection
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Form Evaluasi Lembaga Pengembangan Teknologi Informasi dan Komunikasi (LPTIK)</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
          @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Gagal :</strong>{{ $message }}
          </div>
          @elseif ($message2 = Session::get('success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Gagal :</strong>{{ $message2 }}
          </div>
          @endif
        </div>

        @if (count($indikators)>0)
            <div class="col-md-12">
                <div class="alert alert-info alert-block" id="keterangan">
                    <strong><i class="fa fa-info-circle"></i>&nbsp;Perhatian: </strong> Silahkan isi kuisioner berikut, jika anda simpan kuisioner maka kelas akan otomatis diambil, jika anda ragu silahkan klik batal
                </div>
            </div>
            <div class="col-md-12">
                <form action="{{ route('mahasiswa.post') }}" enctype="multipart/form-data" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('POST') }}
                    <input type="hidden" name="jumlah" value="{{ count($indikators) }}">
                    <input type="hidden" name="nama_lengkap" value="{{ Session::get('nama_lengkap') }}">
                    <input type="hidden" name="username" value="{{ Session::get('username') }}">
                    <input type="hidden" name="akses" value="{{ Session::get('login_as') }}">
                    <input type="hidden" name="prodi" value="{{ Session::get('prodi') }}">
                    <input type="hidden" name="fakultas" value="{{ Session::get('fakultas') }}">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered " id="table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width:10% !important;">Nomor</th>
                                        <th>Soal Evaluasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($indikators as $item)
                                        <tr>
                                            <td style="min-width:30px; text-align:center">{{ $no++ }}.</td>
                                            <td>
                                                <a style="font-weight:bold;">{{ $item->nama_indikator }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <label for="" class="radio-inline">
                                                    <input type="radio" class="flat-red" name="nilai{{ $item->id }}" value="4" required>&nbsp;&nbsp;Sangat Puas <br>
                                                </label>
                                                <br>
                                                <label for="" class="radio-inline">
                                                    <input type="radio" class="flat-red" name="nilai{{ $item->id }}" value="3">&nbsp;&nbsp;Puas <br>
                                                </label>
                                                <br>
                                                <label for="" class="radio-inline">
                                                    <input type="radio" class="flat-red" name="nilai{{ $item->id }}" value="2">&nbsp;&nbsp;Kurang Puas <br>
                                                </label>
                                                <br>
                                                <label for="" class="radio-inline">
                                                    <input type="radio" class="flat-red" name="nilai{{ $item->id }}" value="1">&nbsp;&nbsp;Tidak Puas <br>
                                                </label>
                                            </td>
                                        </tr>
                                        </tr>
                                    @endforeach
                                        <tr style="margin-top:20px !important">
                                            <tr>
                                                <td colspan="2">
                                                    <label for="pesan-teks">Masukan Pesan dan Saran Anda Untuk LPTIK <a style="color: red;">Opsional</a></label>

                                                     <textarea name="saran" id="saran" cols="30" rows="3" class="form-control" placeholder="Masukan Pesan Anda Disini"></textarea></td>
                                              </tr>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="reset" name="reset" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i>&nbsp;Ulangi</button>
                        <button type="submit" onclick="submitForm(this);" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-check-circle"></i>&nbsp;Simpan Evaluasi</button>
                    </div>
                </form>
            </div>
        @else
        <div class="col-md-12">
            <div class="alert alert-danger alert-block">
                <strong><i class="fa fa-info-circle"></i>&nbsp;Informasi: </strong> belum ada indikator evaluasi yang ditambahkan!
            </div>
        </div>
        @endif
      </div>
    </div>
    <!-- /.box-body -->
  </div>
@endsection

@push('scripts')
    <script>
        function submitForm(btn) {
            btn.disabled = true;
            btn.form.submit();
        }
    </script>
@endpush
