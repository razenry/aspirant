<?php

namespace App\Filament\Resources\Users\Pages;

use App\Models\User;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();

        Notification::make()
            ->title('User Created Successfully')
            ->body('The user "' . $this->record->name . '" has been created successfully by ' . Auth::user()->name . '.')
            ->success()
            ->sendToDatabase($admins);
    }
}
