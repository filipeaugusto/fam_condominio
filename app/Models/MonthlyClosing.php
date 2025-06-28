<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyClosing extends Model
{
    public $fillable = [
        'condominium_id',
        'reference',
        'total_fixed_expenses',
        'total_variable_expenses',
        'total_reserve',
        'total_amount',
    ];

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }
}
