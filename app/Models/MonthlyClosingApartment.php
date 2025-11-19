<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $monthly_closing_id
 * @property int $apartment_id
 * @property mixed $amount
 * @property mixed $discount
 * @property mixed $amount_final
 * @property mixed $is_billet_generated
 * @property mixed $billet_generated_at
 * @property mixed $billet_number
 * @property mixed $billet_url
 */
class MonthlyClosingApartment extends Model
{
    public $fillable = [
        'monthly_closing_id',
        'apartment_id',
        'amount',
        'discount',
        'is_billet_generated',
        'billet_generated_at',
        'billet_number',
        'billet_url',
        'is_paid',
        'paid_at',
    ];

    protected $casts = [
//        'amount' => 'decimal:2',
//        'discount' => 'decimal:2',
//        'amount_final' => 'decimal:2',
        'is_paid' => 'boolean',
        'is_billet_generated' => 'boolean',
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
