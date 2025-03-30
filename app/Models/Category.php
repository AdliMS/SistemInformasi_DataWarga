<?php

namespace App\Models;

use App\Models\Civilian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'amount',
    ];

    public function civilians(): BelongsToMany {
        return $this->belongsToMany(Civilian::class, 'employee_pivot_skills', 'employee_id', 'skill_id');
    } // potential error

    // public function civilians(): HasMany
    // {
    //     return $this->hasMany(Civilian::class);
    // }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
