<?php

namespace App\Models;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use App\Models\Scopes\CondominiumScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
        'is_paid',
        'paid_at',
        'payment_method',
        'receipt_path',
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

    protected function label(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => mb_strtoupper($value),
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $dueDate = Carbon::parse($attributes['due_date']);
                $isPaid = $attributes['is_paid'] ?? false; // ou outro campo, ex: 'paid'

                if ($isPaid) {
                    return 'Paga';
                }

                if ($dueDate->isPast()) {
                    return 'Vencida';
                }

                return 'A vencer';
            }
        );
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

    public function scopeOverdue(Builder $query): Builder
    {
        return $query
//            ->where('included_in_closing', false)
            ->where('is_paid', false)
            ->where('due_date', '<', Carbon::today());
    }
}
