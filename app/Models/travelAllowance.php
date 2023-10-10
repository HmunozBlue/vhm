<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class travelAllowance extends Model
{
    protected $table = "travel_allowances";
    protected $guarded = [];

    use HasFactory;
    use SoftDeletes;
}
