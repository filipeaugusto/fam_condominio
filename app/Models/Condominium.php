<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Condominium extends Model
{
    public $fillable = [
        'name',
        'document',
        'logo',
    ];

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }

    public function monthlyClosings(): HasMany
    {
        return $this->hasMany(MonthlyClosing::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
