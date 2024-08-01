<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'id_role' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'id_role' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
