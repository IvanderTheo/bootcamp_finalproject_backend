<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ProductCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('category_name')->required(),
                TextInput::make('category_slug')->required(),
                TextInput::make('description')->required(),
            ]);
    }
}
