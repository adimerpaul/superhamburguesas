<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productoingrediente extends Model
{
    use HasFactory;
    protected $fillable=[
        "cantidad",
        "ingrediente_id",
        "producto_id",
    ];
    protected $hidden = ["created_at", "updated_at"];

    public function ingredientes(){
        return $this->hasMany(Ingrediente::class);
    }
    public function productos(){
        return $this->hasMany(Producto::class);
    }
}
