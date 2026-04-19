<?php

namespace App\Filament\Admin\Resources\Penjualans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Penjualan')
                    ->icon('heroicon-o-shopping-cart')
                    ->schema([
                        TextInput::make('penjualan_kode')
                            ->label('Kode Penjualan')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->validationMessages([
                                'required' => 'Kode penjualan wajib diisi',
                                'unique' => 'Kode penjualan sudah ada',
                                'max' => 'Kode penjualan maksimal 20 karakter',
                            ]),
                        TextInput::make('pembeli')
                            ->label('Nama Pembeli')
                            ->required()
                            ->maxLength(50)
                            ->validationMessages([
                                'required' => 'Nama pembeli wajib diisi',
                                'max' => 'Nama pembeli maksimal 50 karakter',
                            ]),
                        Select::make('user_id')
                            ->label('Petugas (User)')
                            ->relationship('user', 'name')
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'Petugas wajib dipilih',
                            ]),
                        DateTimePicker::make('penjualan_tanggal')
                            ->label('Tanggal Penjualan')
                            ->native(false)
                            ->prefixIcon('heroicon-o-calendar')
                            ->required()
                            ->validationMessages([
                                'required' => 'Tanggal penjualan wajib diisi',
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
