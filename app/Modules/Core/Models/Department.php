<?php

namespace App\Modules\Core\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'is_active'];

    public function jobTitles(): HasMany
    {
        return $this->hasMany(JobTitle::class);
    }
}
