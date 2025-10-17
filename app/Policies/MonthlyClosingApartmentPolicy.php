<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MonthlyClosingApartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlyClosingApartmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MonthlyClosingApartment');
    }

    public function view(AuthUser $authUser, MonthlyClosingApartment $monthlyClosingApartment): bool
    {
        return $authUser->can('View:MonthlyClosingApartment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MonthlyClosingApartment');
    }

    public function update(AuthUser $authUser, MonthlyClosingApartment $monthlyClosingApartment): bool
    {
        return $authUser->can('Update:MonthlyClosingApartment');
    }

    public function delete(AuthUser $authUser, MonthlyClosingApartment $monthlyClosingApartment): bool
    {
        return $authUser->can('Delete:MonthlyClosingApartment');
    }

    public function restore(AuthUser $authUser, MonthlyClosingApartment $monthlyClosingApartment): bool
    {
        return $authUser->can('Restore:MonthlyClosingApartment');
    }

    public function forceDelete(AuthUser $authUser, MonthlyClosingApartment $monthlyClosingApartment): bool
    {
        return $authUser->can('ForceDelete:MonthlyClosingApartment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MonthlyClosingApartment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MonthlyClosingApartment');
    }

    public function replicate(AuthUser $authUser, MonthlyClosingApartment $monthlyClosingApartment): bool
    {
        return $authUser->can('Replicate:MonthlyClosingApartment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MonthlyClosingApartment');
    }

}