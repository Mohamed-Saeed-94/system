<?php

namespace App\Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeLicense extends Model
{
    protected $fillable = [
        'employee_id',
        'license_number',
        'type',
        'issued_at',
        'expires_at',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

