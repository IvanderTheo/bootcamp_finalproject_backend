<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('category.category_name')->searchable(),
                TextColumn::make('product_name')->searchable(),
                TextColumn::make('sku')->searchable(),
                TextColumn::make('description')->searchable(),
                TextColumn::make('price')->searchable()->sortable(),
                TextColumn::make('stock')->searchable()->sortable(),
                TextColumn::make('status')->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
