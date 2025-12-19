<?php

namespace App\Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeePhone extends Model
{
    protected $fillable = ['employee_id', 'phone', 'type'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

