<?php

namespace App\Modules\HR\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeePhone extends Model
{
    use CrudTrait;

    protected $fillable = ['employee_id', 'phone', 'type'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
