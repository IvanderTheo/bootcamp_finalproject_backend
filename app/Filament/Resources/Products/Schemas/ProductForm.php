<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('category.category_name')->required(),
                TextInput::make('product_name')->required(),
                TextInput::make('sku')->required(),
                TextInput::make('description')->required(),
                TextInput::make('price')->required(),
                TextInput::make('stock')->required(),
                Select::make('status')->options([
                    'active'=>'Active',
                    'inactive'=>'Inactive',
                ]),
            ]);
    }
}
