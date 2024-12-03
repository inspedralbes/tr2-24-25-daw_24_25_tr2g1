<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professors';

    // Camps que es poden emplenar
    protected $fillable = [
        'usuari_id',
        'departament', // Camps específics del professor
    ];

    /**
     * Relació amb Usuari.
     */
    public function usuari()
    {
        return $this->belongsTo(Usuari::class, 'usuari_id');
    }
}
