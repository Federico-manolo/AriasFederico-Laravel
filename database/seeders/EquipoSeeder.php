<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB; 

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;



class EquipoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('en_US');
        // Make HTTP request to SportsDataIO API to fetch team data
        $client = new Client();
        $response = $client->get('https://api.sportsdata.io/v3/nba/scores/json/teams?key=fecf4e9eb34b4c47bd2a0de384a51453', [
            'verify' => false
        ]);


        if ($response->getStatusCode() == 200) {
            $teams = json_decode($response->getBody(), true);

            foreach ($teams as $team) {
                $teamName = $team['Name'] ?? null;
                $city = $team['City'] ?? null;
                $logoURL = $team['WikipediaLogoUrl'] ?? null;

                if ($teamName && $city && $logoURL) {
                    // Descargar el archivo de la URL
                    $tempFilePath = tempnam(sys_get_temp_dir(), 'logo');
                    try{    
                        file_put_contents($tempFilePath, file_get_contents($logoURL));

                        // Guardar la imagen en Cloudinary
                        $uploadedFile = Cloudinary::upload($tempFilePath, ['folder' => 'equipos', 'verify' => false]);
                        // Obtener el enlace a la imagen guardada en Cloudinary
                        $cloudinaryUrl = $uploadedFile->getSecurePath();
                    }catch(\Exception $e){
                        $cloudinaryUrl = "";
                    }
                    DB::table('equipo')->insert([
                        'nombre' => $teamName,
                        'ciudad' => $city,
                        'logo' => $cloudinaryUrl, // Guardar el enlace de Cloudinary en lugar del enlace de la API
                        'deleted_at'=> null,
                        ]);
                    
                }
            }

        }
    }
}