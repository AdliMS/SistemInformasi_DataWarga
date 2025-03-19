<?php

namespace App\Models;

use App\Models\Civilian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Liability extends Model
{
    use HasFactory;
    protected $table = 'liabilities';
    protected $guarded = [];

    public function civilian(): BelongsTo {
        return $this->belongsTo(Civilian::class);
    }
}
