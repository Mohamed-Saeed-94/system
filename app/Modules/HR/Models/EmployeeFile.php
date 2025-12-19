<?php

namespace App\Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class EmployeeFile extends Model
{
    protected $fillable = [
        'fileable_id',
        'fileable_type',
        'employee_id',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'category',
        'side',
        'is_primary',
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

