<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MonthlyClosing;
use Illuminate\Auth\Access\HandlesAuthorization;

class MonthlyClosingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MonthlyClosing');
    }

    public function view(AuthUser $authUser, MonthlyClosing $monthlyClosing): bool
    {
        return $authUser->can('View:MonthlyClosing');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MonthlyClosing');
    }

    public function update(AuthUser $authUser, MonthlyClosing $monthlyClosing): bool
    {
        return $authUser->can('Update:MonthlyClosing');
    }

    public function delete(AuthUser $authUser, MonthlyClosing $monthlyClosing): bool
    {
        return $authUser->can('Delete:MonthlyClosing');
    }

    public function restore(AuthUser $authUser, MonthlyClosing $monthlyClosing): bool
    {
        return $authUser->can('Restore:MonthlyClosing');
    }

    public function forceDelete(AuthUser $authUser, MonthlyClosing $monthlyClosing): bool
    {
        return $authUser->can('ForceDelete:MonthlyClosing');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MonthlyClosing');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MonthlyClosing');
    }

    public function replicate(AuthUser $authUser, MonthlyClosing $monthlyClosing): bool
    {
        return $authUser->can('Replicate:MonthlyClosing');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MonthlyClosing');
    }

}