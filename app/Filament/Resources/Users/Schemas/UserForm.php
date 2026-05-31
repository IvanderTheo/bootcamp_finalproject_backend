<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')->required(),
                TextInput::make('email')->required(),
                Select::make('role')->options([
                    'admin'=>'Admin',
                    'user'=>'User',
                ]),
            ]);
    }
}
