<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make()->color('success'),
        ];
    }

    protected function afterSave(): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();

        Notification::make()
            ->title('User Updated Successfully')
            ->body('The user "' . $this->record->name . '" has been updated successfully by ' . Auth::user()->name . '.')
            ->warning()
            ->sendToDatabase($admins);
    }
}
