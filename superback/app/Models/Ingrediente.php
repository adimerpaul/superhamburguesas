<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "grupo_id",
    ];
    protected $hidden = ["created_at", "updated_at"];
}
