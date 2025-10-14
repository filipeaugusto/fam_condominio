<?php

namespace App\Models;

use App\Enums\ExpenseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed $consumption
 * @property mixed $unit_cost
 */
class ConsumptionCharge extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'apartment_id',
        'expense_id',
        'service_class',
        'previous_reading',
        'current_reading',
        'consumption',
        'unit_cost',
        'total_amount',
    ];

    public $casts = [
        'service_class' => ExpenseService::class
    ];

    public function calculateTotal(): float {
        return $this->consumption * $this->unit_cost;
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }
}
