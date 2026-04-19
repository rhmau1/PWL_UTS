<?php

namespace App\Filament\Admin\Resources\PenjualanDetails;

use App\Filament\Admin\Resources\PenjualanDetails\Pages\CreatePenjualanDetail;
use App\Filament\Admin\Resources\PenjualanDetails\Pages\EditPenjualanDetail;
use App\Filament\Admin\Resources\PenjualanDetails\Pages\ListPenjualanDetails;
use App\Filament\Admin\Resources\PenjualanDetails\Schemas\PenjualanDetailForm;
use App\Filament\Admin\Resources\PenjualanDetails\Tables\PenjualanDetailsTable;
use App\Models\t_penjualan_detail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenjualanDetailResource extends Resource
{
    protected static ?string $model = t_penjualan_detail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static ?string $navigationLabel = 'Detail Penjualan';

    protected static ?string $pluralLabel = 'Detail Penjualan';

    protected static ?string $modelLabel = 'Detail Penjualan';

    public static function form(Schema $schema): Schema
    {
        return PenjualanDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualanDetailsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenjualanDetails::route('/'),
            'create' => CreatePenjualanDetail::route('/create'),
            'edit' => EditPenjualanDetail::route('/{record}/edit'),
        ];
    }
}
