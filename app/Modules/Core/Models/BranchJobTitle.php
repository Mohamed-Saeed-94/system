<?php

namespace App\Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BranchJobTitle extends Model
{
    protected $fillable = ['branch_id', 'job_title_id', 'is_active'];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class);
    }
}

