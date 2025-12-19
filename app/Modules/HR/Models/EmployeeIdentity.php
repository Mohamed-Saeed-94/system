<?php

namespace App\Modules\HR\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeIdentity extends Model
{
    use CrudTrait;

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
