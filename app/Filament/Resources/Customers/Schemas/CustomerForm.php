<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->required(),
                Textarea::make('address')
                    ->label('Address')
                    ->required(),
                FileUpload::make('image')
                    ->label('Image')
                    ->required(),
            ]);
    }
}
