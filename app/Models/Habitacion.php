<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;
    protected $table = 'habitaciones';
    // Relación inversa de uno a muchos con la tabla de categorías
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'tipo_h');
    }
}
