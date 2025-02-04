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

            // 1.	Survei Pemahaman Visi dan Misi:

            // 2.	Survei Kepuasan Layanan Manajemen (… diubah dari Survei Kepuasan Dosen dan Tendik): https://bit.ly/SurveiKepuasanPengguna-UNIB. Tambahan pertanyaan di Excel
            ['nama_indikator' => 'UNIB memiliki dan menjalankan sistem seleksi, rekrutmen, orientasi, dan penempatan pegawai.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Ada pemberitahuan atau pengumuman tentang permintaan tenaga dosen atau tenaga pendidik yang baru.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Rekrutmen dosen dan tendik dilakukan secara transparan dan melalui test yang terpercaya.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Saya mendapatkan kesempatan untuk mengikuti pelatihan/workshop/seminar yang dibutuhkan untuk pengembangan diri.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Ada upaya yang sungguh-sungguh dari UNIB untuk peningkatan kompetensi bagi dosen dan tenaga kependidikan sesuai TUPOKSI.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'UNIB menyediakan fasilitas pendukung yang memadai terhadap tanggung jawab pekerjaan yang saya kerjakan.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Informasi yang terkait dan menunjang pekerjaan saya dapat diakses dengan mudah.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'UNIB memberikan informasi dan menyelenggarakan layanan kenaikan jabatan fungsional dan struktural secara periodik.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Sistim kepegawaian di UNIB menentukan jenjang karir dosen dan tenaga kependidikan berdasarkan prestasi kerja.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'UNIB memiliki dan menjalankan sistem pembinaan pegawai dalam bentuk pemberian penghargaan dan sangsi hukuman.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'UNIB telah menyelenggarakan system penggajian, tunjangan dan atau insentif yang layak dan mencukupi.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Saya merasa nyaman dan tenang ditempat kerja karena fasilitas yang tersedia sudah memadai.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan unit kerja memberikan sanksi secara tepat dan adil terhadap kesalahan yang dilakukan dosen dan tenaga kependidikan.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan unit kerja menilai dan mengevaluasi pekerjaan yang dilakukan dosen dan tenaga kependidikan secara periodik.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan unit kerja memberikan pujian dan penghargaan terhadap prestasi yang dicapai dalam pengembangan karir.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan Unit Kerja menanggapi dan menindak lanjuti kritik, saran, dan keluhan yang disampaikan dosen dan tenaga kependidikan.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'UNIB memberikan layanan kebutuhan sosial dan layanan atau santunan kematian.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Ada upaya sungguh-sungguh pimpinan unit kerja memperhatikan kesejahteraan dosen dan tenaga kependidikan melalui kebijakan dan program yang mendukung.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Sosialisasi Struktur Organisasi Tata Kelola tingkat universitas, fakultas, jurusan dan prodi secara efektif', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pemilihan pimpinan lembaga, fakultas/prodi dilaksanakan sesuai peratuan yang berlaku di Universitas Bengkulu', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Keputusan yang diambil oleh pimpinan didahului dengan rapat yang dihadiri oleh dosen dan tendik', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Kebijakan pimpinan dapat diketahui oleh dosen dan tendik.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Kebijakan Pimpinan mengacu pada asas dan norma-norma akademik yang dapat dipertanggungjawabkan', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Konsistensi Pimpinan menegakkan aturan', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Adanya pembagian tugas dan fungsi pimpinan secara jelas sesuai dengan Struktur Organisasi Tata Kelola tingkat universitas, fakultas, jurusan dan prodi secara efektif', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan mengedepankan pendistribusian tugas  dan wewenang kepada semua unsur yang terlibat, baik dosen, pegawai maupun mahasiswa.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Keterlibatan pimpinan dan dosen dalam berbagai kegiatan diluar Universitas Bengkulu', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Perencanaan program kerja/kegiatan dilaksanakan sesuai dengan Rencana Strategis dan Rencana Operasional', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pengorganisasian dilakukan secara efektif.', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan melakukan tugas dan fungsinya sebagai pembina staf, baik staf dosen maupun pegawai (tenaga kependidikan)', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan telah melaksanakan tugas dan fungsinya dengan efektif', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Pimpinan telah melakukan pengawasan,  pemantauan dan terhadap kinerja dosen dan pegawai', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Ketersediaan dokumen penjaminan mutu', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Penjaminan Mutu dilaksanakan secara rutin dan berkesinambungan', 'ditampilkan' => 1, 'category_id' => 2],
            ['nama_indikator' => 'Adanya umpan balik dari hasil audit penjaminan mutu yang dilakukan', 'ditampilkan' => 1, 'category_id' => 2],


            // 3.	Survei Kepuasan Kerja Sama: https://docs.google.com/forms/d/e/1FAIpQLSeYFIkhyp8mq0pr1ykBWeJ4vkQVDEtcjSmAuNMxR3zRuOMxLQ/viewform

            // 4.	Survei Kepuasan Layanan Kemahasiswaan:

            // 5.	Survei Kepuasan Pengguna Sarana dan Pra-Sarana UNIB: https://docs.google.com/forms/d/e/1FAIpQLSdDMrxvBybVLqv_-bIg73EucJj3swYEsrzbcO2BFwX7woECmA/viewform?usp=header
            ['nama_indikator' => 'Ruang kuliah tertata dengan bersih, Rapi dan tersedia fasilitas Pembuangan sampah', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Ruang kuliah sejuk, nyaman dan pengcahayaan memadai', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Sarana pembelajaran yang tersedia di ruang kuliah secara memadai (tersedia LCD, atau Smart TV, dan sebagainya)', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Tersedia fasilitas perpustakaan secara memadai dan lengkap', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Perpustakaan telah melakukan kemutahiran Buku/Referensi/e-journal secara berkala', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Ketersediaan SOP penggunaan Fasilitas Unib', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Standar laboratorium, bengkel yang relevan dengan kebutuhan keilmuan', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Setiap Gedung di Lingkungan Unib tersedia fasilitas Toilet yang bersih, memadai dan dapat dimanfaat oleh berkebutuhan khusus', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Tersedia Fasilitas ibadah, olahraga, kesehatan yang memadai dan mudah diakses', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Tersedia fasilitas, parkir, tangga atau jalur khusus untuk berkebutuhan khusus', 'ditampilkan' => 1, 'category_id' => 5],
            ['nama_indikator' => 'Tersedia fasilitas sistem informasi untuk pendidikan, penelitian dan Pengabdian yang mudah diakses setiap saat', 'ditampilkan' => 1, 'category_id' => 5],

            // 6.	Survei Kepuasan Peneliti dan Mitra Penelitian: https://docs.google.com/forms/d/e/1FAIpQLSdJW84XrZc8I7LlgZkAS_xvHoKdIBP5CdxV-k-Lr_w-xO9PQQ/viewform

            // 7.	Survei Layanan Pengabdian kepada Masyarakat (PkM): https://docs.google.com/forms/d/e/1FAIpQLSe8d7Y4Xr_qNE2UbKPbeszY8UBzyvfTxakcEI6g6DJRMfC-vw/viewform

            // 8.	Survei Kepuasan Pengguna Lulusan: https://bit.ly/3WubDT1
            ['nama_indikator' => 'Etika', 'ditampilkan' => 1, 'category_id' => 8],
            ['nama_indikator' => 'Keahlian Pada bidang Ilmu (Kompetensi Utama)', 'ditampilkan' => 1, 'category_id' => 8],
            ['nama_indikator' => 'Kemampuan Berbahasa Asing', 'ditampilkan' => 1, 'category_id' => 8],
            ['nama_indikator' => 'Penggunaan Teknologi Informasi', 'ditampilkan' => 1, 'category_id' => 8],
            ['nama_indikator' => 'Kemampuan Berkomunikasi', 'ditampilkan' => 1, 'category_id' => 8],
            ['nama_indikator' => 'Kerjasama', 'ditampilkan' => 1, 'category_id' => 8],
            ['nama_indikator' => 'Pengembangan Diri', 'ditampilkan' => 1, 'category_id' => 8],
        ]);
    }
}
