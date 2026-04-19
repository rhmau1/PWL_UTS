<?php

namespace App\Filament\Admin\Resources\Stoks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Informasi Stok')
                    ->icon('heroicon-o-calculator')
                    ->schema([
                        Select::make('supplier_id')
                            ->label('Supplier')
                            ->relationship('supplier', 'supplier_nama')
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'Supplier wajib dipilih',
                            ]),
                        Select::make('barang_id')
                            ->label('Barang')
                            ->relationship('barang', 'barang_nama')
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'Barang wajib dipilih',
                            ]),
                        Select::make('user_id')
                            ->label('Petugas (User)')
                            ->relationship('user', 'name')
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'Petugas wajib dipilih',
                            ]),
                        DateTimePicker::make('stok_tanggal')
                            ->native(false)
                            ->prefixIcon('heroicon-o-calendar')
                            ->label('Tanggal Stok')
                            ->required()
                            ->validationMessages([
                                'required' => 'Tanggal stok wajib diisi',
                            ]),
                        TextInput::make('stok_jumlah')
                            ->label('Jumlah Stok')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->validationMessages([
                                'numeric' => 'Jumlah stok harus berupa angka',
                                'required' => 'Jumlah stok wajib diisi',
                                'min' => 'Jumlah stok minimal 1',
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
