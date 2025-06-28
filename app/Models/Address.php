<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * @var mixed|null
     */
    protected $fillable = [
        'zip_code',
        'addressable_type',
        'addressable_id',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
