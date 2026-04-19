<?php

namespace App\Filament\Admin\Resources\Stoks;

use App\Filament\Admin\Resources\Stoks\Pages\CreateStok;
use App\Filament\Admin\Resources\Stoks\Pages\EditStok;
use App\Filament\Admin\Resources\Stoks\Pages\ListStoks;
use App\Filament\Admin\Resources\Stoks\Schemas\StokForm;
use App\Filament\Admin\Resources\Stoks\Tables\StoksTable;
use App\Models\t_stok;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StokResource extends Resource
{
    protected static ?string $model = t_stok::class;
    protected static ?string $navigationLabel = 'Stok';

    protected static ?string $pluralLabel = 'Stok';

    protected static ?string $modelLabel = 'Stok';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalculator;

    public static function form(Schema $schema): Schema
    {
        return StokForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoksTable::configure($table);
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
            'index' => ListStoks::route('/'),
            'create' => CreateStok::route('/create'),
            'edit' => EditStok::route('/{record}/edit'),
        ];
    }
}
