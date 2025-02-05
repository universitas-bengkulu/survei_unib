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
            ['nama_indikator' => 'UNIB merespon dengan baik permohonan inisiasi kerja sama', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'UNIB merespon dan berkoordinasi dengan baik apabila terjadi permasalahan dalam pelaksanaan kerja sama', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'UNIB memproses Dokumen Kerja Sama secara cepat', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Prosedur memproses Dokumen Kerja Sama dapat dipahami dan dilaksanakan dengan mudah', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Komunikasi dalam pelaksanaan kegiatan kerja sama sudah dilakukan dengan baik', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'UNIB dalam memfasilitasi penyelenggaraan kegiatan kerja sama secara daring maupun luring berjalan dengan baik dan lancar sesuai harapan dari Mitra.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Selama masa berlaku MoU/PKS telah direalisasikan suatu kegiatan kerja sama yang bermanfaat bagi Mitra.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Implementasi kerja sama sesuai dengan Perjanjian Kerja Sama/Kontrak/Surat Perintah Kerja.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Pelaksanaan Kegiatan Kerja Sama sudah dilaksanakan secara tepat waktu oleh Tim ataupun PIC dari UNIB.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'UNIB menghasilkan luaran kerja sama dengan kualitas baik sesuai harapan mitra', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Proses administrasi maupun pelaporan pelaksanaan kegiatan kerja sama kepada Mitra dilakukan secara rapi, transparan dan akuntabel sesuai Perjanjian.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Tim Ahli dari UNIB sudah menggunakan kompetensi dan keahliannya secara maksimal dalam melaksanakan kegiatan kerja sama.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Realisasi kegiatan MoU/KS menghasilkan kegiatan kerja sama yang bermanfaat bagi Mitra', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Mitra ingin melanjutkan kerja sama kembali dengan UNIB di masa mendatang jika ada kesempatan ataupun kebutuhan dari Mitra.', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Jika ya, kira-kira bidang apa yang akan dikerjasamakan', 'ditampilkan' => 1, 'category_id' => 3],
            ['nama_indikator' => 'Apakah Fasilitas yang disediakan UNIB sudah memadai?', 'ditampilkan' => 1, 'category_id' => 3],

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
            ['nama_indikator' => 'Ketersediaan peralatan penelitian yang memadai.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Ketersediaan ruang laboratorium yang memadai.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Kemudahan akses dana penelitian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Bantuan administrasi dan pengurusan perizinan penelitian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Relevansi topik penelitian dengan bidang keahlian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Hasil penelitian yang bermanfaat bagi pengembangan ilmu pengetahuan.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Kemudahan dalam menjalin kerja sama penelitian dengan mitra.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Dukungan mitra dalam pelaksanaan penelitian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Perencanaan riset yang dilakukan oleh para dosen Universitas Bengkulu telah sesuai dengan kebutuhan para mitra riset.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Perencanaan riset telah dilakukan sesuai dengan standar K3 (Keselamatan dan Kesehatan Kerja) bagi mitra riset.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Pelaksanaan riset dilakukan sesuai dengan kaidah metode ilmiah.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Pelaksanaan riset dilaksanakan dengan memperhatikan K3.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Hasil riset sesuai dengan perencanaan riset.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Hasil riset sesuai dengan solusi yang diharapkan oleh mitra.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Hasil riset dapat dimanfaatkan secara maksimal.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Pendanaan riset telah dirasakan cukup memadai bila dibandingkan dengan hasil yang diharapkan.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Kejelasan peran dan tanggung jawab dalam kemitraan.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Komunikasi dan koordinasi dengan tim penelitian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Relevansi hasil penelitian bagi kebutuhan mitra.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Penerapan hasil penelitian dalam praktik di lapangan.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Profesionalisme tim penelitian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Ketepatan waktu dalam penyelesaian penelitian.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Dukungan logistik dan fasilitas dari universitas.', 'ditampilkan' => 1, 'category_id' => 6],
            ['nama_indikator' => 'Responsivitas universitas terhadap kebutuhan mitra.', 'ditampilkan' => 1, 'category_id' => 6],

            // 7.	Survei Layanan Pengabdian kepada Masyarakat (PkM): https://docs.google.com/forms/d/e/1FAIpQLSe8d7Y4Xr_qNE2UbKPbeszY8UBzyvfTxakcEI6g6DJRMfC-vw/viewform
            ['nama_indikator' => 'LPPM menyampaikan persyaratan dan ketentuan relevansi PkM', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Kegiatan PkM memberikan solusi persoalan mitra dan memanfaatkan hasil-hasil PkM untuk hilirisasi ke pemerintah/industri/masyarakat', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM mensosialisasikan panduan pelaksanaan kegiatan PkM dan diberikan kepada seluruh dosen', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM membantu/mendampingi dan memberikan solusi untuk ketercapaian luaran menyelesaikan proses publikasi ilmiah dari hasil PkM yang telah terlaksana.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM memfasilitasi pendaftaran Hak Kekayaan Intelektual (HKI) kegiatan PkM sesuai prosedur publikasi ilmiah terkait luaran dengan menyajikan informasi jurnal – jurnal pengabdian termasuk LPPM menyediakan seminar abdimas maupun jurnal ilmiah pengabdian ber E-ISSN.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Tersedia dana atau pembiayaan pelaksanaan PkM yang berasal dari PNBP UNIB melalui LPPM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM berperan dalam proses PkM yang berasal dari pembiayaan PNBP Fakultas/Prodi di selingkung UNIB.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM menyampaikan/meneruskan informasi PkM yang berasal dari eksternal Universitas Bengkulu (DRTPM/Kosabangsa/lainnya), dan membantu prosesnya.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Tendik LPPM tanggap memberikan pelayanan kepada dosen pelaksana PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Tendik LPPM menyediakan dokumen untuk memperlancar kegiatan PkM yang dilakukan dosen pelaksana PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM menginformasikan jadwal pelaksanaan sesuai rangkaian kegiatan PkM (pengajuan proposal, pelaporan, serta monitoring dan evaluasi).', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM melakukan monitoring dan evaluasi serta membuat laporan pelaksanaan kegiatan PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM mengevaluasi hasil-hasil pengabdian kepada masyarakat yang dilaksanakan oleh dosen pengabdi sesuai dengan panduan.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM memberikan sanksi kepada pengabdi yang lalai dalam pertanggungan jawab pelaksanaan kegiatan pengabdian kepada masyarakat.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Pencairan dana kegiatan PkM sesuai ketentuan yang berlaku.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM menetapkan kriteria pelaksanaan PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM menyelenggarakan pelatihan, seminar atau lokakarya terkait dengan PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM mensosialisasi informasi terkait pelaksanaan PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM menyelenggarakan kegiatan PkM secara terarah, terukur, dan terprogram dengan menetapkan desa binaan dan topik kegiatan yang sesuai.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Proses pelaksanaan kegiatan PkM ini telah sesuai dengan harapan Bapak/Ibu.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Tendik LPPM memberi pelayanan yang sopan dan ramah.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Tendik LPPM melayani dosen pelaksana dalam pengurusan administrasi PkM dengan baik.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM memberikan kemudahan mendapatkan informasi mengenai pelaksanaan kegiatan PkM di Universitas Bengkulu.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'LPPM memberikan kemudahan mengakses sistem prismalppm.unib.ac.id untuk melengkapi persyaratan dalam kegiatan PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Ketersediaan fasilitas dan ruangan yang representatif menunjang pengurusan kegiatan PkM.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Universitas Bengkulu memiliki sarana prasarana sebagai pendukung proses kegiatan PkM (laboratorium dengan peralatan yang memadai, ruangan seminar atau diskusi dan lain-lainnya).', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Ketersediaan panduan pelaksanaan PkM di Universitas Bengkulu.', 'ditampilkan' => 1, 'category_id' => 7],
            ['nama_indikator' => 'Tersedia panduan atau template PkM.', 'ditampilkan' => 1, 'category_id' => 7],

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
