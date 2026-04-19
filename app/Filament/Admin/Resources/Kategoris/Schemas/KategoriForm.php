<?php

namespace App\Filament\Admin\Resources\Kategoris\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Informasi Kategori')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        TextInput::make('kategori_kode')
                            ->label('Kategori Kode')
                            ->unique()
                            ->minLength(3)
                            ->maxLength(10)
                            ->required(),
                        TextInput::make('kategori_nama')
                            ->label('Kategori Nama')
                            ->maxLength(100)
                            ->required(),
                    ]),
            ]);
    }
}
