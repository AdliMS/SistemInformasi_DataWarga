<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $guarded = [];

    public function civilians(): BelongsToMany {
        return $this->belongsToMany(Civilian::class, 'civilian_pivot_subscriptions')
        ->withPivot('temp_amount');  
    }

    public function categories(): HasMany {
        return $this->hasMany(Category::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
