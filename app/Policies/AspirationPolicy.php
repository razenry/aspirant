<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Aspiration;
use Illuminate\Auth\Access\HandlesAuthorization;

class AspirationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Aspiration');
    }

    public function view(AuthUser $authUser, Aspiration $aspiration): bool
    {
        return $authUser->can('View:Aspiration');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Aspiration');
    }

    public function update(AuthUser $authUser, Aspiration $aspiration): bool
    {
        return $authUser->can('Update:Aspiration');
    }

    public function delete(AuthUser $authUser, Aspiration $aspiration): bool
    {
        return $authUser->can('Delete:Aspiration');
    }

    public function restore(AuthUser $authUser, Aspiration $aspiration): bool
    {
        return $authUser->can('Restore:Aspiration');
    }

    public function forceDelete(AuthUser $authUser, Aspiration $aspiration): bool
    {
        return $authUser->can('ForceDelete:Aspiration');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Aspiration');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Aspiration');
    }

    public function replicate(AuthUser $authUser, Aspiration $aspiration): bool
    {
        return $authUser->can('Replicate:Aspiration');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Aspiration');
    }

}