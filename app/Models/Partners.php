<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $guarded = [];

    use HasFactory;

     /**
     * Relación: un partner tiene muchas visitas
     */
    public function visits()
    {
        return $this->hasMany(Visit::class, 'partner_id');
    }
}
