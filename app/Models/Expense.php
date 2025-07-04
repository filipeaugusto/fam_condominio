<?php

namespace App\Models;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use App\Models\Scopes\CondominiumScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    public $fillable = [
        'condominium_id',
        'type',
        'service_class',
        'label',
        'amount',
        'due_date',
        'included_in_closing',
        'monthly_closing_id',
    ];

    public $casts = [
        'due_date' => 'date',
        'included_in_closing' => 'boolean',
        'type' => ExpenseType::class,
        'service_class' => ExpenseService::class
    ];

    protected static function booted(): void
    {
//        static::addGlobalScope(new CondominiumScope);
    }


    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

    public function monthlyClosing(): BelongsTo
    {
        return $this->belongsTo(MonthlyClosing::class);
    }

    public static function getTypes(): string
    {
        return ExpenseType::class;
    }
    public static function getServices(): string
    {
        return ExpenseService::class;
    }
}
