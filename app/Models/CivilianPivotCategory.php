<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Civilian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CivilianPivotCategory extends Model
{
    use HasFactory;
    protected $table = 'civilian_pivot_categories';
    protected $fillable = [
        'civilian_id',
        'category_id',

    ];

    // Relasi ke model Employee
    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class);
    }

    // Relasi ke model SkillCategory
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
