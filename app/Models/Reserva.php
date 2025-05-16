<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id', 'fecha_reserva', 'hora_reserva',
        'cantidad_personas', 'total', 'estado', 'info_adicional'
    ];

    public static function obtenerFechasBloqueadas()
    {
        return self::selectRaw('fecha_reserva, hora_reserva, SUM(cantidad_personas) as total')
            ->groupBy('fecha_reserva', 'hora_reserva')
            ->having('total', '>=', 250)
            ->get()
            ->groupBy('fecha_reserva');
    }
}