<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\UploadFile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadFilePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:UploadFile');
    }

    public function view(AuthUser $authUser, UploadFile $uploadFile): bool
    {
        return $authUser->can('View:UploadFile');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:UploadFile');
    }

    public function update(AuthUser $authUser, UploadFile $uploadFile): bool
    {
        return $authUser->can('Update:UploadFile');
    }

    public function delete(AuthUser $authUser, UploadFile $uploadFile): bool
    {
        return $authUser->can('Delete:UploadFile');
    }

    public function restore(AuthUser $authUser, UploadFile $uploadFile): bool
    {
        return $authUser->can('Restore:UploadFile');
    }

    public function forceDelete(AuthUser $authUser, UploadFile $uploadFile): bool
    {
        return $authUser->can('ForceDelete:UploadFile');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:UploadFile');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:UploadFile');
    }

    public function replicate(AuthUser $authUser, UploadFile $uploadFile): bool
    {
        return $authUser->can('Replicate:UploadFile');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:UploadFile');
    }

}