<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{   
    protected $table = 'carta';
    use HasFactory,SoftDeletes;
    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
    
}
