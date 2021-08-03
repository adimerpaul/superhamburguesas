<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "precio",
        "cantidad",
        "subtotal",
        'cliente_id',
        'user_id',
        'agencia_id',
        'producto_id',
        'pedido_id',
    ];
}
