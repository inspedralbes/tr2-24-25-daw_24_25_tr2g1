<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacio extends Model
{
    protected $table = 'publicacions';

    protected $fillable = [
        'id_usuari',
        'titol',
        'especialitat',
        'contingut',
        'data_publicacio',
        'hora_inici',
        'hora_final',
        // 'imatge',
        // 'views_count',
        // 'publlicacio_data',
    ];

    public function publicacio()
    {
        return $this->belongsTo(Usuari::class, 'id_usuari');
    }
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
