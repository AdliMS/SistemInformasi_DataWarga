<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CivilianPivotSubscription extends Model
{
    use HasFactory;
    protected $table = 'civilian_pivot_subscriptions';
    protected $fillable = [
        'civilian_id',
        'subscription_id',
        'paid_months'
    ];

    protected $casts = [
        'paid_months' => 'array', // Pastikan ini ada
    ];

    public function getIsPaidAttribute()
    {
        return !empty($this->paid_months);
    }

    // Relasi ke model Employee
    public function civilian(): BelongsTo
    {
        return $this->belongsTo(Civilian::class);
    }

    // Relasi ke model Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
