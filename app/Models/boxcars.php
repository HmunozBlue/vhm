<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class boxcars extends Model
{
    protected $table = "boxcars";
    protected $guarded = [];

    use HasFactory;
    use SoftDeletes;
}
