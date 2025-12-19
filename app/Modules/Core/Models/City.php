<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'is_active'];
}

