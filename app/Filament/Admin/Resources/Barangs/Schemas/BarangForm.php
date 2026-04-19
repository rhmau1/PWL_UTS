<?php

namespace App\Filament\Admin\Resources\Barangs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Informasi Barang')
                ->icon('heroicon-o-archive-box')
                ->schema([
                    TextInput::make('barang_kode')
                    ->unique()
                    ->minLength(3)
                    ->maxLength(10)
                    ->required()
                    ->label('Barang kode')
                    ->validationMessages([
                        'minlength' => 'Kode barang minimal 3 karakter',
                        'maxlength' => 'Kode barang maksimal 10 karakter',
                        'unique' => 'Kode barang sudah ada',
                        'required' => 'Kode barang wajib diisi',
                    ]),
                    TextInput::make('barang_nama')
                    ->required()
                    ->minLength(3)
                    ->maxLength(100)
                    ->label('Barang nama')
                    ->validationMessages([
                        'minlength' => 'Nama barang minimal 3 karakter',
                        'maxlength' => 'Nama barang maksimal 100 karakter',
                        'required' => 'Nama barang wajib diisi',
                    ]),
                    TextInput::make('harga_beli')
                    ->prefix('Rp.')
                    ->numeric()
                    ->label('Harga beli')
                    ->rule('gt:0')
                    ->required()
                    ->validationMessages([
                        'numeric' => 'Harga beli harus berupa angka',
                        'required' => 'Harga beli wajib diisi',
                        'gt' => 'Harga beli harus lebih besar dari 0',
                    ]),
                    TextInput::make('harga_jual')
                    ->prefix('Rp.')
                    ->numeric()
                    ->required()
                    ->label('Harga jual')
                    ->rule('gt:0')
                    ->validationMessages([
                        'numeric' => 'Harga jual harus berupa angka',
                        'required' => 'Harga jual wajib diisi',
                        'gt' => 'Harga jual harus lebih besar dari 0',
                    ]),
                    Select::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'kategori_nama')
                    ->required()
                    ->validationMessages([
                        'required' => 'Kategori wajib diisi',
                    ]),
                ])
                ->columnSpanFull(),

            ]);
    }
}
