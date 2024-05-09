<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Carta;

class Pedido extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'pedido';
    public function cartasEnPedido(){
        return $this->belongsToMany(Carta::class, 'cartas_en_pedido','pedido_id','carta_id')->withPivot('cant_producto');
    }
}
