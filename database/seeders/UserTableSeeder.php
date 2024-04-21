<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'surname' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('AdminP8ssw0rd'),
                'role' => 'admin',
                'status' => '1'
            ]
        ]);
    }
}
