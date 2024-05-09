<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB; 


class PedidoSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        $users = DB::table('users')->pluck('id'); // obtenemos todos los IDs de usuarios existentes
        $cartas = DB::table('carta')->pluck('id'); // obtenemos todos los IDs de cartas existentes

        for($i=0; $i<60; $i++ ){
            $user_id = $users->random(); // obtenemos un ID de usuario aleatorio

            $carta_ids = $cartas->random(random_int(1, 3));

            // Generar cant_producto para cada carta
            $cant_productos = [];
            foreach ($carta_ids as $carta_id) {
                $cant_productos[$carta_id] = $faker->numberBetween(1, 3);
            }
            
            $costos_cartas = DB::table('carta')->whereIn('id', $carta_ids)->pluck('costo','id');

            $monto_total = 0;
            //Obtenemos monto_total, sumando los costos de cada carta (multiplicado por la cantidad de cada carta)
            foreach ($carta_ids as $carta_id) {
                $monto_total += $costos_cartas[$carta_id] * $cant_productos[$carta_id];
            }
            
            $pedido_id = DB::table('pedido')->insertGetId([
                'estado' => $faker->randomElement(['Pendiente','Procesando','Enviado','Entregado']),
                'fecha_pedido' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
                'fecha_entrega' => $faker->dateTimeBetween('+1 month', '+2 month')->format('Y-m-d'), 
                'monto_total'=> $monto_total,
                'user_id'=>$user_id,
                'deleted_at'=> null,
            ]);

            // Insertar las cartas en la tabla 'cartas_en_pedido'
            foreach ($carta_ids as $carta_id) {
                DB::table('cartas_en_pedido')->insert([
                    'cant_producto' => $cant_productos[$carta_id],
                    'carta_id' => $carta_id,
                    'pedido_id' => $pedido_id,
                    'deleted_at'=> null,
                ]);
            }
        }     
    }
}
