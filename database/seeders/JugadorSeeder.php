<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Provider\en_US\Person as FakerBasketball;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class JugadorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('en_US');
        // Make HTTP request to SportsDataIO API to fetch team data
        $client = new Client();
        $response = $client->get('https://api.sportsdata.io/v3/nba/scores/json/Players?key=fecf4e9eb34b4c47bd2a0de384a51453', [
            'verify' => false
        ]);
        $responseEquipo = $client->get('https://api.sportsdata.io/v3/nba/scores/json/teams?key=fecf4e9eb34b4c47bd2a0de384a51453', [
            'verify' => false
        ]);

        if ($responseEquipo->getStatusCode() == 200) { //success
            $equipos = json_decode($responseEquipo->getBody(), true);
            $equiposMap = [];

            // Loop through each object in the returned JSON
            foreach ($equipos as $equipo) {
                // Extract "Team" and "Key" fields from the JSON object
                $team = $equipo['Name'];
                $key = $equipo['Key'];

                // Create a mapping of team names to their corresponding key
                $equiposMap[$key] = $team;
            }
        }
        if ($response->getStatusCode() == 200) { //success
            $jugadores = json_decode($response->getBody(), true);

            foreach ($jugadores as $jugador) {
                $nombre = $jugador['FirstName'] ?? null;
                $apellido = $jugador['LastName'] ?? null;
                print("-".$apellido);
                $numero = $jugador['Jersey'] ?? 0;
                $posicion = $jugador['Position'] ?? "GN";
                $equipoNombre = $jugador['Team'] ?? null;
                $pais = $jugador['BirthCountry'] ?? null;
                $foto = $jugador['PhotoUrl'] ?? null;


                $equipoKey = $equiposMap[$equipoNombre]; // Get the key of the team from the mapping
                $equipoId = DB::table('equipo')->where('nombre', $equipoKey)->pluck('id')->first(); // Get the ID of the team from the database;
                DB::table('jugador')->insert([ 
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'numero' => $numero,
                    'posicion' => $posicion,
                    'equipo_id' => $equipoId, // Insert the ID of the team as foreign key
                    'nacionalidad' => $pais,
                    'foto' => $foto,
                    'deleted_at'=> null,
                ]);
            }
        }
    }
}

