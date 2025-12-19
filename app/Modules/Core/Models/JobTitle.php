<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobTitle extends Model
{
    protected $fillable = ['name', 'department_id', 'is_active'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}

