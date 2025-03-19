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
        'category_id',
        'subscription_id',
        'temp_amount'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            $subscription->calculateTempAmount();
        });

        static::updating(function ($subscription) {
            $subscription->calculateTempAmount();
        });
    }

    public function calculateTempAmount()
    {
        $civilian = Civilian::with('category')->find($this->civilian_id);
        $subscription = Subscription::find($this->subscription_id);

        $categoryAmount = $civilian?->category?->amount ?? 0;
        $subscriptionAmount = $subscription?->amount ?? 0;

        // Menjumlahkan amount dari category dan subscription
        $this->temp_amount = $categoryAmount + $subscriptionAmount;
    }


    

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

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
