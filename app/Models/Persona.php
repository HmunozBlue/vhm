<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $guarded = [];

    use HasFactory;

    /**
     * Una persona puede tener muchas visitas
     */
    public function visits()
    {
        return $this->hasMany(Visit::class, 'persona_id');
    }
}
