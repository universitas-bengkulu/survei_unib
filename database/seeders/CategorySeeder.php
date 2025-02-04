<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            //dosen tendik
            [ 'nama_category' => 'Survei Pemahaman Visi dan Misi', 'slug' => 'survei-visi-misi'],
            [ 'nama_category' => 'Survei Kepuasan Layanan Manajemen', 'slug' => 'survei-layanan-manajemen'],
            [ 'nama_category' => 'Survei Kepuasan Kerja Sama', 'slug' => 'survei-kerja-sama'],
            [ 'nama_category' => 'Survei Kepuasan Layanan Kemahasiswaan', 'slug' => 'survei-layanan-kemahasiswaan'],
            [ 'nama_category' => 'Survei Kepuasan Pengguna Sarana dan Pra-Sarana UNIB', 'slug' => 'survei-sarana-prasarana'],
            [ 'nama_category' => 'Survei Kepuasan Peneliti dan Mitra Penelitian', 'slug' => 'survei-penelitian'],
            [ 'nama_category' => 'Survei Layanan Pengabdian kepada Masyarakat', 'slug' => 'survei-pengabdian-kepadamasyarakat'],
            [ 'nama_category' => 'Survei Kepuasan Pengguna Lulusan', 'slug' => 'survei-lulusan'],

        ]);
    }
}
