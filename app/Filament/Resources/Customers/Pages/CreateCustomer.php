<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;


class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
    protected static bool $canCreateAnother = false;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::create($data);
    }
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', [
            'record' => $this->record,
        ]);
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'User registered';
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }

    // if no need notification
    // protected function getCreatedNotification(): ?Notification
    // {
    //     return null;
    // }
}
