<?php

namespace App\Filament\Admin\Widgets;

use App\Models\m_barang;
use App\Models\m_supplier;
use App\Models\t_penjualan_detail;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlyRevenue = DB::table('t_penjualan_detail')
            ->join('t_penjualan', 't_penjualan_detail.penjualan_id', '=', 't_penjualan.penjualan_id')
            ->whereMonth('t_penjualan.penjualan_tanggal', $currentMonth)
            ->whereYear('t_penjualan.penjualan_tanggal', $currentYear)
            ->select(DB::raw('SUM(t_penjualan_detail.harga * t_penjualan_detail.jumlah) as total'))
            ->first()->total ?? 0;

        $lowStockCount = DB::table('t_stok')
            ->select('barang_id', DB::raw('SUM(stok_jumlah) as total_stok'))
            ->groupBy('barang_id')
            ->having('total_stok', '<', 10)
            ->count();

        $totalSuppliers = m_supplier::count();

        return [
            Stat::make('Monthly Revenue', 'Rp ' . number_format($monthlyRevenue, 0, ',', '.'))
                ->description('Total sales for ' . Carbon::now()->format('F Y'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Low Stock Items', $lowStockCount)
                ->description('Items below 10 units')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStockCount > 0 ? 'danger' : 'success'),
            Stat::make('Total Suppliers', $totalSuppliers)
                ->description('Active supply partners')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),
        ];
    }
}
