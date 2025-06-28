<?php

namespace App\Models;

use App\Models\Scopes\CondominiumScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;
    public $fillable = [
        'condominium_id',
        'identifier',
        'fraction',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new CondominiumScope);
    }


    public function condominium(): BelongsTo
    {
        return $this->belongsTo(Condominium::class);
    }
}
