<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $fillable = [
        'condominium_id',
        'type',
        'label',
        'amount',
        'due_date',
        'included_in_closing',
        'monthly_closing_id',
    ];
}
