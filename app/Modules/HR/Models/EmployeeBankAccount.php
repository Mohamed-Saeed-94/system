<?php

namespace App\Modules\HR\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeBankAccount extends Model
{
    use CrudTrait;

    protected $fillable = [
        'employee_id',
        'name_in_bank',
        'bank_name',
        'account_number',
        'iban',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
