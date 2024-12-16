<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacio extends Model
{
    protected $table = 'publicacions';

    protected $fillable = [
        'titol',
        'contingut',
        'estat',
        'id_usuari',
        'hora_inici',
        'hora_final',
        'dia',
        'especialitat',
        // 'imatge',
        // 'views_count',
        // 'publlicacio_data',
    ];

    public function publicacio()
    {
        return $this->belongsTo(Usuari::class, 'id_usuari');
    }
}
