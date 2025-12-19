<?php

namespace App\Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeIdentity extends Model
{
    protected $fillable = [
        'employee_id',
        'identity_number',
        'issued_at',
        'expires_at',
        'sponsor_name',
        'sponsor_id_number',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

