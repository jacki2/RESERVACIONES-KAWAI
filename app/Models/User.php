<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable; // Importación necesaria

class User extends Authenticatable
{
    use Billable; // Trait agregado

    protected $fillable = [
        'name', 
        'email', 
        'telefono',  // Campo personalizado
        'password'   // ¡Asegúrate de incluir este campo si existe!
    ];

    protected $hidden = [
        'password',
        'remember_token', // Si usas autenticación tradicional
    ];
}