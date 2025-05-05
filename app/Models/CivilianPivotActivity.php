<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CivilianPivotActivity extends Pivot
{
    use HasFactory;

    protected $table = 'civilian_pivot_activities';

    protected $fillable = [
        'civilian_id',
        'activity_id',
        'progress'
    ];

    public function civilian()
    {
        return $this->belongsTo(Civilian::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}