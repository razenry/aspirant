<?php

namespace App\Filament\Resources\UploadFiles\Pages;

use App\Filament\Resources\UploadFiles\UploadFileResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreateUploadFile extends CreateRecord
{
    protected static string $resource = UploadFileResource::class;

    protected function afterCreate(): void
    {
        $admins = User::role(['admin', 'super_admin'])->get();

        $fileLabel = $this->record->jenis_file->label();

        Notification::make()
            ->title('File Uploaded')
            ->body("File '{$fileLabel}' uploaded by " . Auth::user()->name . ".")
            ->success()
            ->sendToDatabase($admins);
    }
}
