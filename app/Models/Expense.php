<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $table = 'expenses';
    protected $fillable = [
        'expense_name', 
        'amount',
        'is_income',
        'subscription_id',
        'civilian_pivot_subscription_id'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Pastikan tidak ada property yang menghalangi
    protected $guarded = [];

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function civilianPivotSubscription(): BelongsTo
    {
        return $this->belongsTo(CivilianPivotSubscription::class, 'civilian_pivot_subscription_id');
    }
}
