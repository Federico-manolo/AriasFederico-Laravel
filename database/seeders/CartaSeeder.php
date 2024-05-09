<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Add this line

class CartaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $jugadores = DB::table('jugador')->pluck('id');

        foreach ($jugadores as $jugador) {

            // Generate a valid image path and save the image

            DB::table('carta')->insert([
                'descripcion' => ('Descripción de cada carta por separado'),
                'costo' => $faker->numberBetween(1, 99) * 10,
                'estadistica' => $faker->numberBetween(50, 99),
                'categoria' => $faker->randomElement(['Bronce', 'Plata', 'Oro']),
                'jugador_id' => $jugador,
                'deleted_at'=> null,
            ]);
        }
    }
}
