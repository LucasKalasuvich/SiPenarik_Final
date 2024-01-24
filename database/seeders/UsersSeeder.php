<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'nama' => 'Lucas Kalasuvich',
            'username' => 'lucas',
            'password' => Hash::make('lucas123'),
            'email' => 'lucaskalasuvich2001@gmail.com',
            'bagian' => 'PUSTEKINFO',
            'username' => 'lucas',
            'nip' => '908932782167237834',
            'telepon' => '08127483625',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
