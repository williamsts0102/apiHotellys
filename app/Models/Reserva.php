<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_habitacion',
        'id_usuario',
        'pago_reserva',
        'numero_transaccion',
        'codigo_reserva',
        'descripcion_reserva',
        'fecha_ingreso',
        'fecha_salida',
        'fecha_reserva',
    ];
    
    // Definir la relación: una reserva pertenece a una habitación
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'id_habitacion');
    }
}
