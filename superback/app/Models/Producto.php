<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "descripcion",
        "precio",
        "stock",
        "tipo",
        "imagen",
        "activo",
        "agencia_id",
        "rubro_id",
    ];
    protected $hidden = ["created_at", "updated_at"];
    public function rubro(){
        return $this->belongsTo(Rubro::class);
    }

    public function incluyes(){
        return $this->hasMany(Incluye::class);
    }

    public function ingredientes(){
        return $this->hasMany(Ingrediente::class);

    }

}
