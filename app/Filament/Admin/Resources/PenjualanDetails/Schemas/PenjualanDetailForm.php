<?php

namespace App\Filament\Admin\Resources\PenjualanDetails\Schemas;

use App\Models\m_barang;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PenjualanDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Detail Penjualan')
                    ->icon('heroicon-o-list-bullet')
                    ->schema([
                        Select::make('penjualan_id')
                            ->label('Transaksi Penjualan')
                            ->relationship('penjualan', 'penjualan_kode')
                            ->preload()
                            ->required()
                            ->validationMessages([
                                'required' => 'Transaksi penjualan wajib dipilih',
                            ]),
                        Select::make('barang_id')
                            ->label('Barang')
                            ->relationship('barang', 'barang_nama')
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if (filled($state)) {
                                    $barang = m_barang::find($state);
                                    if ($barang) {
                                        $set('harga', $barang->harga_jual);
                                    }
                                }
                            })
                            ->validationMessages([
                                'required' => 'Barang wajib dipilih',
                            ]),
                        TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->default(1)
                            ->validationMessages([
                                'required' => 'Jumlah wajib diisi',
                                'numeric' => 'Jumlah harus berupa angka',
                                'min' => 'Jumlah minimal 1',
                            ]),
                        TextInput::make('harga')
                            ->label('Harga (Satuan)')
                            ->numeric()
                            ->prefix('Rp.')
                            ->required()
                            ->readOnly()
                            ->validationMessages([
                                'required' => 'Harga wajib diisi',
                                'numeric' => 'Harga harus berupa angka',
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
