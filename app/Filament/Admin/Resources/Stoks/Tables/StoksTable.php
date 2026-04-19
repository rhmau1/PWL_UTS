<?php

namespace App\Filament\Admin\Resources\Stoks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class StoksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('barang.barang_nama')
                    ->wrap()
                    ->searchable()
                    ->sortable()
                    ->label('Barang'),
                TextColumn::make('supplier.supplier_nama')
                    ->searchable()
                    ->sortable()
                    ->label('Supplier'),
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('Petugas (User)'),
                BadgeColumn::make('stok_jumlah')
                    ->label('Jumlah Stok'),
                TextColumn::make('stok_tanggal')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d M, Y'))
                    ->label('Tanggal Stok'),
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
