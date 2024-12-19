<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentors';

    protected $fillable = [
        'usuari_id',
        'especialitat', // Camps específics del mentor
    ];

    /**
     * Relació amb Usuari.
     */
    public function usuari()
    {
        return $this->belongsTo(Usuari::class, 'usuari_id');
    }
}
