<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class IndikatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indikators')->insert([
            ['id' => 1, 'nama_indikator' => 'UNIB memiliki dan menjalankan sistem seleksi, rekrutmen, orientasi, dan penempatan pegawai.', 'ditampilkan' => 1],
            ['id' => 2, 'nama_indikator' => 'Ada pemberitahuan atau pengumuman tentang permintaan tenaga dosen atau tenaga pendidik yang baru.', 'ditampilkan' => 1],
            ['id' => 3, 'nama_indikator' => 'Rekrutmen dosen dan tendik dilakukan secara transparan dan melalui test yang terpercaya.', 'ditampilkan' => 1],
            ['id' => 4, 'nama_indikator' => 'Saya mendapatkan kesempatan untuk mengikuti pelatihan/workshop/seminar yang dibutuhkan untuk pengembangan diri.', 'ditampilkan' => 1],
            ['id' => 5, 'nama_indikator' => 'Ada upaya yang sungguh-sungguh dari UNIB untuk peningkatan kompetensi bagi dosen dan tenaga kependidikan sesuai TUPOKSI.', 'ditampilkan' => 1],
            ['id' => 6, 'nama_indikator' => 'UNIB menyediakan fasilitas pendukung yang memadai terhadap tanggung jawab pekerjaan yang saya kerjakan.', 'ditampilkan' => 1],
            ['id' => 7, 'nama_indikator' => 'Informasi yang terkait dan menunjang pekerjaan saya dapat diakses dengan mudah.', 'ditampilkan' => 1],
            ['id' => 8, 'nama_indikator' => 'UNIB memberikan informasi dan menyelenggarakan layanan kenaikan jabatan fungsional dan struktural secara periodik.', 'ditampilkan' => 1],
            ['id' => 9, 'nama_indikator' => 'Sistim kepegawaian di UNIB menentukan jenjang karir dosen dan tenaga kependidikan berdasarkan prestasi kerja.', 'ditampilkan' => 1],
            ['id' => 10, 'nama_indikator' => 'UNIB memiliki dan menjalankan sistem pembinaan pegawai dalam bentuk pemberian penghargaan dan sangsi hukuman.', 'ditampilkan' => 1],
            ['id' => 11, 'nama_indikator' => 'UNIB telah menyelenggarakan system penggajian, tunjangan dan atau insentif yang layak dan mencukupi.', 'ditampilkan' => 1],
            ['id' => 12, 'nama_indikator' => 'Saya merasa nyaman dan tenang ditempat kerja karena fasilitas yang tersedia sudah memadai.', 'ditampilkan' => 1],
            ['id' => 13, 'nama_indikator' => 'Pimpinan unit kerja memberikan sanksi secara tepat dan adil terhadap kesalahan yang dilakukan dosen dan tenaga kependidikan.', 'ditampilkan' => 1],
            ['id' => 14, 'nama_indikator' => 'Pimpinan unit kerja menilai dan mengevaluasi pekerjaan yang dilakukan dosen dan tenaga kependidikan secara periodik.', 'ditampilkan' => 1],
            ['id' => 15, 'nama_indikator' => 'Pimpinan unit kerja memberikan pujian dan penghargaan terhadap prestasi yang dicapai dalam pengembangan karir.', 'ditampilkan' => 1],
            ['id' => 16, 'nama_indikator' => 'Pimpinan Unit Kerja menanggapi dan menindak lanjuti kritik, saran, dan keluhan yang disampaikan dosen dan tenaga kependidikan.', 'ditampilkan' => 1],
            ['id' => 17, 'nama_indikator' => 'UNIB memberikan layanan kebutuhan sosial dan layanan atau santunan kematian.', 'ditampilkan' => 1],
            ['id' => 18, 'nama_indikator' => 'Ada upaya sungguh-sungguh pimpinan unit kerja memperhatikan kesejahteraan dosen dan tenaga kependidikan melalui kebijakan dan program yang mendukung.', 'ditampilkan' => 1],
        ]);
    }
}
