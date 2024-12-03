<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacio extends Model
{
    protected $table = 'publicacions';

    protected $fillable = [
        'titol',
        'contingut',
        'imatge',
        'estat',
        'id_usuari',
        'views_count',
        'publlicacio_data',
    ];

    public function publicacio()
    {
        return $this->belongsTo(Usuari::class, 'id_usuari');
    }
}
