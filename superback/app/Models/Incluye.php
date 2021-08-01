<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incluye extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "producto_id",
    ];
    protected $hidden = ["created_at", "updated_at"];
}
