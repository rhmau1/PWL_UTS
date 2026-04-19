<?php

namespace App\Filament\Admin\Resources\Penjualans\Schemas;

use App\Models\t_penjualan;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;

class PenjualanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components(function (t_penjualan $record) {
                return [
                    Section::make('Informasi Penjualan')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TextEntry::make('penjualan_kode')
                                ->label('Kode Penjualan')
                                ->badge(),
                            TextEntry::make('penjualan_tanggal')
                                ->label('Tanggal Transaksi')
                                ->dateTime('d M, Y H:i'),
                            TextEntry::make('user.name')
                                ->label('Nama Petugas'),                            
                            TextEntry::make('pembeli')
                                ->label('Nama Pembeli'),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),

                    Section::make('Detail Item Penjualan')
                        ->icon('heroicon-o-shopping-cart')
                        ->schema([
                            RepeatableEntry::make('details')
                                ->hiddenLabel()
                                ->schema([
                                    Grid::make(4)
                                        ->schema([
                                            TextEntry::make('barang.barang_nama')
                                                ->hiddenLabel(),
                                            TextEntry::make('harga')
                                                ->hiddenLabel()
                                                ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                                                ->alignment('right'),
                                            TextEntry::make('jumlah')
                                                ->hiddenLabel()
                                                ->alignment('center'),
                                            TextEntry::make('subtotal')
                                                ->hiddenLabel()
                                                ->state(fn ($record) => number_format($record->harga * $record->jumlah, 0, ',', '.'))
                                                ->alignment('right'),
                                        ]),
                                ])
                                ->columnSpanFull(),                    
                            Grid::make(2)
                                ->schema([
                                    Text::make('TOTAL AKHIR')
                                        ->weight('bold')
                                        ->size('lg'),
                                    TextEntry::make('total')
                                        ->hiddenLabel()
                                        ->state(fn (t_penjualan $record) => 'Rp. '.number_format($record->details->sum(fn ($detail) => $detail->harga * $detail->jumlah), 0, ',', '.'))
                                        ->weight('bold')
                                        ->size('lg')
                                        ->color('primary')
                                        ->alignment('right'),
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull(),
                ];
            });
    }
}
