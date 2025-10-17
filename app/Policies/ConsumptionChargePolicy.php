<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ConsumptionCharge;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConsumptionChargePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ConsumptionCharge');
    }

    public function view(AuthUser $authUser, ConsumptionCharge $consumptionCharge): bool
    {
        return $authUser->can('View:ConsumptionCharge');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ConsumptionCharge');
    }

    public function update(AuthUser $authUser, ConsumptionCharge $consumptionCharge): bool
    {
        return $authUser->can('Update:ConsumptionCharge');
    }

    public function delete(AuthUser $authUser, ConsumptionCharge $consumptionCharge): bool
    {
        return $authUser->can('Delete:ConsumptionCharge');
    }

    public function restore(AuthUser $authUser, ConsumptionCharge $consumptionCharge): bool
    {
        return $authUser->can('Restore:ConsumptionCharge');
    }

    public function forceDelete(AuthUser $authUser, ConsumptionCharge $consumptionCharge): bool
    {
        return $authUser->can('ForceDelete:ConsumptionCharge');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ConsumptionCharge');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ConsumptionCharge');
    }

    public function replicate(AuthUser $authUser, ConsumptionCharge $consumptionCharge): bool
    {
        return $authUser->can('Replicate:ConsumptionCharge');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ConsumptionCharge');
    }

}