<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 


class UsuarioSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i <   25; $i++){
            DB::table('users')->insert([
                'name'=> $faker -> name(),
                'email'=> $faker -> unique()->email(),
                'password'=> bcrypt($faker->password()),
                'email_verified_at' => null,
                'deleted_at'=> null,
            ]);    
        }
    }
}





