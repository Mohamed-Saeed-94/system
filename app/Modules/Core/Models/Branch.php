<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = ['name', 'address', 'city_id', 'is_active'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function branchDepartments(): HasMany
    {
        return $this->hasMany(BranchDepartment::class);
    }

    public function branchJobTitles(): HasMany
    {
        return $this->hasMany(BranchJobTitle::class);
    }
}

