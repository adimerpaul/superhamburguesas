<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    protected $fillable=['producto_id','producto_id2','tipo','nombre'];
    public function producto(){
        return $this->belongsTo(Producto::class);
    }
    public function producto2(){
        return $this->belongsTo(Producto::class);
    }
}
