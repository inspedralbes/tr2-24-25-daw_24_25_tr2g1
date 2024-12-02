<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuari extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuaris';

    // Camps que es poden emplenar mitjançant assignació massiva
    protected $fillable = [
        'nom',
        'cognom1',
        'cognom2',
        'email',
        'password',
        'telefon',
        'biografia',
        'data_naixement',
        'major',
        'rol',
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
