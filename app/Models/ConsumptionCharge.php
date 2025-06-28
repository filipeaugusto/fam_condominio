<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsumptionCharge extends Model
{
    protected $fillable = [
        'condominium_id',
        'expense_id',
        'previous_reading',
        'current_reading',
        'consumption',
        'unit_cost',
        'total_amount',
    ];

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }
}
