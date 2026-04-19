<?php

namespace App\Filament\Admin\Resources\Suppliers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Informasi Supplier')
                ->icon('heroicon-o-receipt-percent')
                ->schema([
                    Group::make()
                    ->schema([
                        TextInput::make('supplier_kode')
                        ->label('Supplier Kode')
                        ->required()
                        ->unique()
                        ->maxLength(10)
                        ->columnSpan(1),
                        TextInput::make('supplier_nama')
                        ->label('Supplier Nama')
                        ->required()
                        ->maxLength(100)
                        ->columnSpan(1),
                    ])->columns(2),
                TextInput::make('supplier_alamat')
                ->label('Supplier Alamat')
                ->required()
                ->maxLength(255)
                ])
                ->columnSpanFull(),
            ]);
    }
}
