<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyClosing extends Model
{
    use SoftDeletes;

    public $fillable = [
        'condominium_id',
        'reference',
        'total_fixed',
        'total_variable',
        'total_reserve',
        'total_emergency',
        'total_amount',
    ];

    protected $casts = [
        'reference' => 'date',
    ];

    protected static function booted(): void
    {
        static::deleting(function (self $closing) {
            if ($closing->isForceDeleting()) {
                $closing->monthlyClosingApartments()->forceDelete();
            } else {
                $closing->monthlyClosingApartments()->delete();
            }
        });
    }

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

    public function monthlyClosingApartments(): HasMany
    {
        return $this->hasMany(MonthlyClosingApartment::class);
    }
}
