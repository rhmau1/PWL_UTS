<?php

namespace App\Filament\Admin\Resources\Barangs\Schemas;

use App\Models\m_user;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Informasi Barang')
                        ->icon('heroicon-o-archive-box')
                        ->schema([
                            TextInput::make('barang_kode')
                                ->unique(ignoreRecord: true)
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
                        ]),
                    Step::make('Stok Awal')
                        ->icon('heroicon-o-calculator')
                        ->schema([
                            Repeater::make('stoks')
                                ->relationship('stoks')
                                ->schema([
                                    Select::make('supplier_id')
                                        ->label('Supplier')
                                        ->relationship('supplier', 'supplier_nama')
                                        ->preload()
                                        ->required()
                                        ->validationMessages([
                                            'required' => 'Supplier wajib dipilih',
                                        ]),
                                    Select::make('user_id')
                                        ->label('Petugas (User)')
                                        ->relationship('user', 'name')
                                        ->default(fn () => Auth::id())
                                        ->preload()
                                        ->required()
                                        ->validationMessages([
                                            'required' => 'Petugas wajib dipilih',
                                        ]),
                                    DateTimePicker::make('stok_tanggal')
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->label('Tanggal Stok')
                                        ->default(now())
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
                                ->minItems(1)
                                ->maxItems(1)
                                ->addable(false)
                                ->deletable(false)
                                ->label('Informasi Stok Awal')
                        ])
                ])
                ->columnSpanFull(),
            ]);
    }
}
