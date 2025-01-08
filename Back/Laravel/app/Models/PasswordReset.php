<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
     // Deshabilitar timestamps
     public $timestamps = false;
     // Indicar que la clave primaria es 'email'
     protected $primaryKey = 'email';
     // Indicar que la clave primaria es una cadena
     protected $keyType = 'string';
     // Indicar que no es autoincremental
     public $incrementing = false;

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    // Indicar que no uses la convención de nomenclatura predeterminada
    protected $table = 'password_resets';
}
