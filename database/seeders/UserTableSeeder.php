<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = [
            [
                'nm_lengkap'    =>  'operator',
                'username'    =>  'operator',
                'password'    =>  bcrypt("password"),
                'email'     =>  'operator@mail.com',
                'unit' =>  'administrator',
                'akses' =>  'administrator',
                'aktif'    =>  1,
            ],

        ];
        User::insert($user);
    }
}
