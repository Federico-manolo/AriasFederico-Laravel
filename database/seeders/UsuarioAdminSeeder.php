<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
                'name'=> "admin",
                'email'=> "admin@iaw.com",
                'password'=> bcrypt("admin123"),
                'email_verified_at' => null,
                'deleted_at'=> null,
            ]);    
    }
}
