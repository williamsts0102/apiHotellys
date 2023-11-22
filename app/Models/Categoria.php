<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Relación uno a muchos con la tabla de habitaciones
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class, 'tipo_h');
    }
}
