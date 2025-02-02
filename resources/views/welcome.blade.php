@extends('layouts.layout')
@section('login')

@endsection
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title" style="line-height: 1.5;font-size:16px"> 
        Survei ini dilakukan untuk melihat kepuasan Pengguna untuk Dosen dan Tenaga Kependidikan Universitas Bengkulu (UNIB).
        Beri penilaian terhadap item-item penilaian di bawah ini dengan cara memilih salah satu opsi pada kolom Persepsi.
        <br>
        Kriteria Penilaian 
        <ul>
            <li><strong>Sangat Baik</strong> = Nilai 5</li>
            <li><strong>Baik</strong> = Nilai 4</li>
            <li><strong>Cukup</strong> = Nilai 3</li>
            <li><strong>Kurang</strong> = Nilai 2</li>
            <li><strong>Sangat Kurang</strong> = Nilai 1</li>
        </ul>
         Atas kesediaan semua responden yang telah berpartisipasi dalam pengisian kuesioner ini kami ucapkan terima kasih.</h3>
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
             @if(session('message'))
                <div class="col-md-12 alert alert-{{ session('alert-type') }}">
                    {{ session('message') }}
                </div>
            @endif

            @foreach ($errors->all() as $error)
                <div class=" col-md-12 alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
            </div>
            <div class="col-md-12">
                <form action="{{ route('evaluasi.post') }}"   method="POST"  >
                    @csrf
                    <input type="hidden" name="jumlah" value="{{ count($indikators) }}">
                    <input type="hidden" name="nama_lengkap" value="{{ Session::get('nama_lengkap') }}">
                    <input type="hidden" name="username" value="{{ Session::get('username') }}">
                    <input type="hidden" name="akses" value="{{ Session::get('login_as') }}">
                    <input type="hidden" name="prodi" value="{{ Session::get('prodi') }}">
                    <input type="hidden" name="fakultas" value="{{ Session::get('fakultas') }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div   class="alert alert-warning alert-block">
                                <tr>
                                    <td colspan="2">
                                        <label for="jenis_kelamin">Nama (Tanpa Gelar)</label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Anda Disini" required>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="2" >
                                        <label for="pekerjaan" style="padding-top:10px">pekerjaan</label>
                                        <select name="pekerjaan" id="pekerjaan" class="form-control" onchange="toggleInput()" required>
                                            <option disabled selected>-- pilih pekerjaan--</option>
                                            <option value="Dosen">Dosen</option>
                                            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option> 
                                        </select> 
                                    </td>
                                </tr>
                                </div>



                            <table class="table table-striped table-bordered table-hover " id="table" style="width:100%;margin-top:20px">
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
                                            <label for="nilai_{{ $item->id }}_5" class="radio-inline">
                                                <input type="radio" class="flat-red" id="nilai_{{ $item->id }}_5" name="nilai{{ $item->id }}" value="5" required>&nbsp;&nbsp;Sangat baik <br>
                                            </label><br>
                                            <label for="nilai_{{ $item->id }}_4" class="radio-inline">
                                                <input type="radio" class="flat-red" id="nilai_{{ $item->id }}_4" name="nilai{{ $item->id }}" value="4" required>&nbsp;&nbsp;Baik <br>
                                            </label><br>
                                            <label for="nilai_{{ $item->id }}_3" class="radio-inline">
                                                <input type="radio" class="flat-red" id="nilai_{{ $item->id }}_3" name="nilai{{ $item->id }}" value="3" required>&nbsp;&nbsp;Cukup <br>
                                            </label><br>
                                            <label for="nilai_{{ $item->id }}_2" class="radio-inline">
                                                <input type="radio" class="flat-red" id="nilai_{{ $item->id }}_2" name="nilai{{ $item->id }}" value="2" required>&nbsp;&nbsp;Kurang <br>
                                            </label><br>
                                            <label for="nilai_{{ $item->id }}_1" class="radio-inline">
                                                <input type="radio" class="flat-red" id="nilai_{{ $item->id }}_1" name="nilai{{ $item->id }}" value="1" required>&nbsp;&nbsp;Sangat Kurang <br>
                                            </label>

                                            </td>
                                        </tr>
                                    @endforeach
                                        <tr style="margin-top:20px !important">
                                            <tr>
                                                <td colspan="2">
                                                    <label for="pesan-teks">Masukan Pesan dan Saran Anda Untuk Dosen dan Tenaga Kependidikan Universitas Bengkulu <a style="color: red;">Opsional</a></label>

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

