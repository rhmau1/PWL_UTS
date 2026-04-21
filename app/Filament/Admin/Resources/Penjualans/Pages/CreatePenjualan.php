<?php

namespace App\Filament\Admin\Resources\Penjualans\Pages;

use App\Filament\Admin\Resources\Penjualans\PenjualanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function afterCreate(): void
    {
        $penjualan = $this->record;
        $penjualan->load('details');

        foreach ($penjualan->details as $detail) {
            $remainingToDeduct = $detail->jumlah;

            $stoks = \App\Models\t_stok::where('barang_id', $detail->barang_id)
                ->where('stok_jumlah', '>', 0)
                ->orderBy('stok_tanggal', 'asc')
                ->get();

            foreach ($stoks as $stok) {
                if ($remainingToDeduct <= 0) {
                    break;
                }

                if ($stok->stok_jumlah >= $remainingToDeduct) {
                    $stok->stok_jumlah -= $remainingToDeduct;
                    $stok->save();
                    $remainingToDeduct = 0;
                } else {
                    $remainingToDeduct -= $stok->stok_jumlah;
                    $stok->stok_jumlah = 0;
                    $stok->save();
                }
            }
        }
    }
}
