<?php

namespace App\Filament\Admin\Resources\Penjualans\Schemas;

use App\Models\m_barang;
use App\Models\t_stok;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Informasi Penjualan')
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
                                ->default(fn () => Auth::id())
                                ->preload()
                                ->required()
                                ->validationMessages([
                                    'required' => 'Petugas wajib dipilih',
                                ]),
                            DateTimePicker::make('penjualan_tanggal')
                                ->label('Tanggal Penjualan')
                                ->native(false)
                                ->prefixIcon('heroicon-o-calendar')
                                ->default(now())
                                ->required()
                                ->validationMessages([
                                    'required' => 'Tanggal penjualan wajib diisi',
                                ]),
                        ]),
                    Step::make('Detail Barang')
                        ->icon('heroicon-o-list-bullet')
                        ->schema([
                            Repeater::make('details')
                                ->relationship('details')
                                ->schema([
                                    Select::make('barang_id')
                                        ->label('Barang')
                                        ->relationship('barang', 'barang_nama', modifyQueryUsing: function ($query) {
                                            return $query->whereIn('barang_id', function ($q) {
                                                $q->from('t_stok')
                                                    ->select('barang_id')
                                                    ->groupBy('barang_id')
                                                    ->havingRaw('SUM(stok_jumlah) > 0');
                                            });
                                        })
                                        ->preload()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems()
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
                                        ->maxValue(function (Get $get) {
                                            if (! $get('barang_id')) {
                                                return null;
                                            }

                                            return t_stok::where('barang_id', $get('barang_id'))->sum('stok_jumlah');
                                        })
                                        ->hint(function (Get $get) {
                                            if (! $get('barang_id')) {
                                                return null;
                                            }

                                            $stok = t_stok::where('barang_id', $get('barang_id'))->sum('stok_jumlah');

                                            return "Stok tersedia: {$stok}";
                                        })
                                        ->hintColor('primary')
                                        ->default(1)
                                        ->live()
                                        ->validationMessages([
                                            'required' => 'Jumlah wajib diisi',
                                            'numeric' => 'Jumlah harus berupa angka',
                                            'min' => 'Jumlah minimal 1',
                                            'max' => 'Jumlah melebihi stok yang tersedia',
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
                                ->columns(3)
                                ->label('Daftar Barang yang Dibeli')
                                ->minItems(1)
                                ->validationMessages([
                                    'min' => 'Minimal harus ada 1 barang',
                                ]),
                        ])
                ])
                ->columnSpanFull(),
            ]);
    }
}
