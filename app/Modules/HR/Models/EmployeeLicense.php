<?php

namespace App\Modules\HR\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeLicense extends Model
{
    use CrudTrait;

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
