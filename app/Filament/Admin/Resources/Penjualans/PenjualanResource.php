<?php

namespace App\Filament\Admin\Resources\Penjualans;

use App\Filament\Admin\Resources\Penjualans\Pages\CreatePenjualan;
use App\Filament\Admin\Resources\Penjualans\Pages\EditPenjualan;
use App\Filament\Admin\Resources\Penjualans\Pages\ListPenjualans;
use App\Filament\Admin\Resources\Penjualans\Schemas\PenjualanForm;
use App\Filament\Admin\Resources\Penjualans\Tables\PenjualansTable;
use App\Models\t_penjualan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenjualanResource extends Resource
{
    protected static ?string $model = t_penjualan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $navigationLabel = 'Penjualan';

    protected static ?string $pluralLabel = 'Penjualan';

    protected static ?string $modelLabel = 'Penjualan';

    protected static ?string $recordTitleAttribute = 'penjualan_kode';

    public static function form(Schema $schema): Schema
    {
        return PenjualanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualansTable::configure($table);
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
            'index' => ListPenjualans::route('/'),
            'create' => CreatePenjualan::route('/create'),
            'edit' => EditPenjualan::route('/{record}/edit'),
        ];
    }
}
