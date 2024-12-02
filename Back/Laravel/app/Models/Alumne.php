<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumne extends Model
{
    use HasFactory;

    protected $table = 'alumnes';

    protected $fillable = [
        'usuari_id',
        'curs',
    ];

    /**
     * Relació amb Usuari.
     */
    public function usuari()
    {
        return $this->belongsTo(Usuari::class, 'usuari_id');
    }
}
