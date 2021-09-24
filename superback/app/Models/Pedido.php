<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable=[
        "fecha",
        "hora",
        "total",
        'agencia_id',
        'user_id',
        'cliente_id',
    ];
    public function incluyes(){
        return $this->hasMany(Incluye::class);
    }
    public function detalles(){
        return $this->hasMany(Detalle::class)->with('subdetalles');
    }
}
