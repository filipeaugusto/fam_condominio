<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Condominium;
use Illuminate\Auth\Access\HandlesAuthorization;

class CondominiumPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Condominium');
    }

    public function view(AuthUser $authUser, Condominium $condominium): bool
    {
        return $authUser->can('View:Condominium');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Condominium');
    }

    public function update(AuthUser $authUser, Condominium $condominium): bool
    {
        return $authUser->can('Update:Condominium');
    }

    public function delete(AuthUser $authUser, Condominium $condominium): bool
    {
        return $authUser->can('Delete:Condominium');
    }

    public function restore(AuthUser $authUser, Condominium $condominium): bool
    {
        return $authUser->can('Restore:Condominium');
    }

    public function forceDelete(AuthUser $authUser, Condominium $condominium): bool
    {
        return $authUser->can('ForceDelete:Condominium');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Condominium');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Condominium');
    }

    public function replicate(AuthUser $authUser, Condominium $condominium): bool
    {
        return $authUser->can('Replicate:Condominium');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Condominium');
    }

}