<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuari extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'usuaris';

    // Camps que es poden emplenar mitjançant assignació massiva
    protected $fillable = [
        'nom',
        'cognom1',
        'cognom2',
        'password',
        'data_naixement',
        'rol',
        'correu',
        'correualternatiu',
        'pregunta_secreta',
        'resposta_secreta',
        'telefon',
        'biografia',
        'major',
    ];

    // Camps ocults per a arrays, útil per protegir dades sensibles
    protected $hidden = [
        'password',
    ];

    /**
     * Relacions.
     */
    public function alumne()
    {
        return $this->hasOne(Alumne::class, 'usuari_id');
    }

    public function mentor()
    {
        return $this->hasOne(Mentor::class, 'usuari_id');
    }

    public function professor()
    {
        return $this->hasOne(Professor::class, 'usuari_id');
    }
}
