<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subproducto extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'precio',
        'cantidad',
        'producto_id',
    ];
}
