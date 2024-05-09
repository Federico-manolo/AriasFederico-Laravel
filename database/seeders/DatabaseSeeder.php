<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(UsuarioSeeder::class);
        $this->call(EquipoSeeder::class);
        $this->call(JugadorSeeder::class);
        $this->call(CartaSeeder::class);
        $this->call(PedidoSeeder::class);
        $this->call(UsuarioAdminSeeder::class);
    }
}
