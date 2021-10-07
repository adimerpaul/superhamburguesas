<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IngredienteProducto;

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
        'star',
        'mostrar'
    ];
    protected $hidden = ["created_at", "updated_at"];

    public function rubro(){
        return $this->belongsTo(Rubro::class);
    }
    public function agencia(){
        return $this->belongsTo(Agencia::class);
    }

    public function incluyes(){
        return $this->hasMany(Incluye::class);
    }
//    public function combos(){
//        return $this->hasMany(Combo::class);
//    }

    public function ingredienteproducto(){
        return $this->belongsTo(IngredienteProducto::class);
    }

    public function ingredientes(){
        return $this->belongsToMany(Ingrediente::class)->withPivot('cantidad');
    }
    public function combos(){
        return$this->hasMany(Combo::class);
    }
    public function subproductos(){
        return$this->hasMany(Subproducto::class);
    }

}
