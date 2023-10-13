<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uuid = Str::uuid();

        DB::table('users')->insert([
            'uuid'          => $uuid,
            'id_role'       => 1,
            'name'          => 'admin',
            'email'         => 'admin@gmail.com',
            'password'      => Hash::make('admin123'),
        ]);
    }
}
