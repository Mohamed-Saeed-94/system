<?php

namespace App\Modules\Core\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nationality extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'name_en', 'is_active'];

    public function employees(): HasMany
    {
        return $this->hasMany(\App\Modules\HR\Models\Employee::class);
    }
}
