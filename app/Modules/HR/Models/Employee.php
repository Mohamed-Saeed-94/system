<?php

namespace App\Modules\HR\Models;

use App\Modules\Core\Models\Branch;
use App\Modules\Core\Models\Department;
use App\Modules\Core\Models\JobTitle;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Employee extends Model
{
    use CrudTrait;

    protected $fillable = [
        'name',
        'name_en',
        'hire_date',
        'branch_id',
        'department_id',
        'job_title_id',
        'is_active',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(EmployeePhone::class);
    }

    public function identities(): HasMany
    {
        return $this->hasMany(EmployeeIdentity::class);
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(EmployeeLicense::class);
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(EmployeeBankAccount::class);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(EmployeeFile::class, 'fileable');
    }

    public function getFullNameAttribute(): string
    {
        return $this->name ?: $this->english_name;
    }
}
