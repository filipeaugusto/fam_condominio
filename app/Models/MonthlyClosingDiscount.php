<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyClosingDiscount extends Model
{
    protected $fillable = [
        'monthly_closing_id',
        'apartment_id',
        'amount',
        'reason',
        'applied',
        'applied_at',
        'created_by',
    ];

    public function closing(): BelongsTo
    {
        return $this->belongsTo(MonthlyClosing::class, 'monthly_closing_id');
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
