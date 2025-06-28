<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CondominiumScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        $builder->where('condominium_id', $user->condominium_id ?? 1);

//        if ($user && $user->hasRole(['syndic', 'financial_manager', 'resident'])) {
//            $builder->where('condominium_id', $user->condominium_id);
//        }
    }
}
