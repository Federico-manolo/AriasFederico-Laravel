<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jugador extends Model
{
    protected $table = 'jugador';
    use HasFactory,SoftDeletes;
    public function cartas()
    {
        return $this->hasMany(Carta::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
    
}