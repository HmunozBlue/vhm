<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];

    use HasFactory;

    /**
     * Relación: una visita pertenece a un cliente (partner)
     */
    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    /**
     * Una visita pertenece a una persona
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'technician_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Persona::class, 'technician_id');
    }
}
