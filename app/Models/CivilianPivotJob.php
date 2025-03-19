<?php

namespace App\Models;

use App\Models\Civilian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CivilianPivotJob extends Model
{
    use HasFactory;
    protected $table = 'civilian_pivot_jobs';
    protected $fillable = [
        'civilian_id',
        'civilian_job_id',
        'accepted_date',
        'retirement_date'
    ];

    // Relasi ke model Employee
    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class);
    }

    // Relasi ke model SkillCategory
    public function civilian_job(): BelongsTo
    {
        return $this->belongsTo(CivilianJob::class);
    }
}
