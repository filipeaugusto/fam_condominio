<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $monthly_closing_id
 * @property int $apartment_id
 * @property mixed $amount
 * @property mixed $discount
 */
class MonthlyClosingApartment extends Model
{
    public $fillable = [
        'monthly_closing_id',
        'apartment_id',
        'amount',
        'discount',
        'is_paid',
        'paid_at',
    ];

    protected $casts = [
//        'amount' => 'decimal:2',
//        'discount' => 'decimal:2',
//        'amount_final' => 'decimal:2',
    ];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function monthlyClosing(): BelongsTo
    {
        return $this->belongsTo(MonthlyClosing::class);
    }
}
