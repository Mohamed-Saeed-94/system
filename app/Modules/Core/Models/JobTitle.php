<?php

namespace App\Modules\Core\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobTitle extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'name_en', 'department_id', 'is_active'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
