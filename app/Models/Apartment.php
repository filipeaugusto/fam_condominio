<?php

namespace App\Models;

use App\Models\Scopes\CondominiumScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;

    public $fillable = [
        'condominium_id',
        'identifier',
        'fraction',
    ];

    protected $appends = ['resident_name'];

    protected static function booted(): void
    {
        static::addGlobalScope(new CondominiumScope);
    }

    public function latestResident(): HasOne
    {
        return $this->hasOne(Resident::class)->latestOfMany();
    }

    protected function residentName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->latestResident?->user?->name ?? '-'
        );
    }

    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }

    public function consumptionCharges(): HasMany
    {
        return $this->hasMany(ConsumptionCharge::class);
    }

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }
}
