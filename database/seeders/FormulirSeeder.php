<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormulirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formulirs')->insert([
            //dosen tendik
            //Formulir Survei Kepuasan Layanan Manajemen
            [ 'category_id' => 2, 'label' => 'Email','variable' => 'email', 'type' => 'email','required' => 1, 'additional' => ''],
            [ 'category_id' => 2, 'label' => 'Nama (Tanpa Gelar)','variable' => 'nama', 'type' => 'text','required' => 1, 'additional' => ''],
            [ 'category_id' => 2, 'label' => 'Pekerjaan','variable' => 'kerja', 'type' => 'radio','required' => 1, 'additional' => 'Dosen; Tenaga Kependidikan'],

            //Formulir Survei Kepuasan Kerja Sama
            [ 'category_id' => 3, 'label' => 'Kategori Mitra','variable' => 'mitra', 'type' => 'select', 'required' => 1, 'additional' => 'Pemerintah (Kementrian/Pemda/Badan, dst); BUMN/BUMD; Institusi Pendidikan/Perguruan Tinggi; Organisasi Nirlaba (Yayasan/LSM/Asosiasi); Fasilitas Kesehatan (Rumah Sakit/Puskesmas/Klinik, dst); Industri/Perusahaan/Perbankan Swasta; Perorangan/Individu; Lainnya'],
            [ 'category_id' => 3, 'label' => 'Nama Instansi/Perusahaan/Institusi','variable' => 'nama', 'type' => 'text','required' => 1, 'additional' => ''],
            [ 'category_id' => 3, 'label' => 'Alamat Instansi/Perusahaan/Institusi','variable' => 'alamat', 'type' => 'text','required' => 0, 'additional' => ''],
            [ 'category_id' => 3, 'label' => 'Nomor Telepon/HP','variable' => 'hp', 'type' => 'number','required' => 0, 'additional' => ''],
            [ 'category_id' => 3, 'label' => 'Email','variable' => 'email', 'type' => 'email','required' => 0, 'additional' => ''],

            //Formulir Survei Kepuasan Layanan Kemahasiswaan
            [ 'category_id' => 4, 'label' => 'Fakultas','variable' => 'fakultas', 'type' => 'select', 'required' => 1, 'additional' => 'Keguruan dan Ilmu Kependidikan; Hukum; Ekonomi dan Bisnis; Ilmu Sosial dan Politik; Pertanian; Matematika dan Ilmu Pengetahuan Alam; Teknik; Kedokteran dan Ilmu Kesehatan'],
            [ 'category_id' => 4, 'label' => 'Program Studi','variable' => 'prodi', 'type' => 'text','required' => 1, 'additional' => ''],

            //Formulir Survei Kepuasan Pengguna Sarana dan Pra-Sarana UNIB
            [ 'category_id' => 5, 'label' => 'Email','variable' => 'email', 'type' => 'email','required' => 1, 'additional' => ''],
            [ 'category_id' => 5, 'label' => 'Pengguna','variable' => 'kerja', 'type' => 'radio','required' => 1, 'additional' => 'Dosen; Mahasiswa'],

              //Formulir Survei Kepuasan Peneliti dan Mitra Penelitian
              [ 'category_id' => 6, 'label' => 'Umur','variable' => 'umur', 'type' => 'text','required' => 1, 'additional' => ''],
              [ 'category_id' => 6, 'label' => 'Jenis Kelamin	','variable' => 'jenis', 'type' => 'checkbox', 'required' => 1, 'additional' => 'Laki-laki; Perempuan'],
              [ 'category_id' => 6, 'label' => 'Fakultas','variable' => 'fakultas', 'type' => 'select', 'required' => 1, 'additional' => 'Keguruan dan Ilmu Kependidikan; Hukum; Ekonomi dan Bisnis; Ilmu Sosial dan Politik; Pertanian; Matematika dan Ilmu Pengetahuan Alam; Teknik; Kedokteran dan Ilmu Kesehatan; Mitra'],


              //Formulir Survei Layanan Pengabdian kepada Masyarakat
              [ 'category_id' => 7, 'label' => 'Email','variable' => 'email', 'type' => 'email','required' => 1, 'additional' => ''],
              [ 'category_id' => 7, 'label' => 'Skema Pendanaan Pengabdian','variable' => 'dana', 'type' => 'radio', 'required' => 1, 'additional' => 'LPPM; Fakultas; Program Studi; Other:'],
              [ 'category_id' => 7, 'label' => 'Skema Pengabdian','variable' => 'skema', 'type' => 'radio','required' => 1, 'additional' => 'Pembinaan; IPTEKS; Riset; Wilayah Sekitar Kampus; Other:;'],
              [ 'category_id' => 7, 'label' => 'Tahun Pelaksanaan','variable' => 'tahun', 'type' => 'date','required' => 1, 'additional' => ''],
              [ 'category_id' => 7, 'label' => 'Nama (Lengkap Dengan Gelar)','variable' => 'lengkap', 'type' => 'text','required' => 1, 'additional' => ''],
              [ 'category_id' => 7, 'label' => 'Fakultas','variable' => 'fakultas', 'type' => 'select', 'required' => 1, 'additional' => 'Keguruan dan Ilmu Kependidikan; Hukum; Ekonomi dan Bisnis; Ilmu Sosial dan Politik; Pertanian; Matematika dan Ilmu Pengetahuan Alam; Teknik; Kedokteran dan Ilmu Kesehatan'],
              [ 'category_id' => 7, 'label' => 'Program Studi','variable' => 'prodi', 'type' => 'text','required' => 1, 'additional' => ''],

              //Formulir Survei Survei Kepuasan Pengguna Lulusan
            [ 'category_id' => 8, 'label' => 'Nama Perusahaan','variable' => 'perusahaan', 'type' => 'text','required' => 1, 'additional' => ''],
            [ 'category_id' => 8, 'label' => 'Jabatan','variable' => 'jabatan', 'type' => 'text','required' => 1, 'additional' => ''],
            [ 'category_id' => 8, 'label' => 'Nama Alumni Yang Dinilai','variable' => 'alumni', 'type' => 'text','required' => 1, 'additional' => ''],
            [ 'category_id' => 8, 'label' => 'Program Studi Alumni Yang Dinilai','variable' => 'prodialumni', 'type' => 'text','required' => 1, 'additional' => ''],
        ]);
    }
}
