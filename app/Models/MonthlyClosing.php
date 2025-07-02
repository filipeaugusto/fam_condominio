<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyClosing extends Model
{
    use SoftDeletes;
    public $fillable = [
        'condominium_id',
        'reference',
        'total_fixed_expenses',
        'total_variable_expenses',
        'total_reserve',
        'total_amount',
    ];

    protected $casts = [
        'reference' => 'date',
    ];

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }
}
