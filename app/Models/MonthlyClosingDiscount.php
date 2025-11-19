<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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


    protected function reason(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper($value),
        );
    }

    public function monthlyClosing(): BelongsTo
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
