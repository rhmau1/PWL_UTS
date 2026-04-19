<?php

namespace App\Filament\Admin\Resources\Barangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('barang_kode')
                ->label('Barang Kode')
                ->searchable()
                ->sortable(),
                TextColumn::make('barang_nama')
                ->label('Barang Nama')
                ->searchable()
                ->sortable()
                ->wrap(),
                TextColumn::make('harga_beli')
                ->label('Harga Beli')
                ->sortable()
                ->formatStateUsing(fn($state) => 'Rp. ' . number_format($state, 0, ',', '.')),  
                TextColumn::make('harga_jual')
                ->label('Harga Jual')
                ->sortable()
                ->formatStateUsing(fn($state) => 'Rp. ' . number_format($state, 0, ',', '.')),  
                TextColumn::make('kategori.kategori_nama')
                ->label('Kategori')
                ->sortable(),
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
