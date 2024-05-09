<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Jugador;

class Equipo extends Model
{
    protected $table = 'equipo';
    use HasFactory,SoftDeletes;
    public function jugadoresAsociados()
    {
        return $this->hasMany(Jugador::class);        
    }
}
 