<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productogrupo extends Model
{
    use HasFactory;
    protected $fillable=[
        "cantidad",
        "grupo_id",
        "producto_id",
    ];
    protected $hidden = ["created_at", "updated_at"];

    public function grupo(){
        return $this->belongsTo(Grupo::class);
    }
}
