<?php

namespace App\Filament\Admin\Resources\Penjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penjualan_kode')
                    ->label('Kode Penjualan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pembeli')
                    ->label('Nama Pembeli')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Petugas (User)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('penjualan_tanggal')
                    ->label('Tanggal Penjualan')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('d M, Y H:i')),
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
