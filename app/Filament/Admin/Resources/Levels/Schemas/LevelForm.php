<?php

namespace App\Filament\Admin\Resources\Levels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make('Informasi Level')
                    ->icon('heroicon-o-rectangle-stack')
                    ->schema([
                        TextInput::make('level_kode')
                            ->label('Level Kode')
                            ->unique()
                            ->minLength(3)
                            ->maxLength(10)
                            ->required(),
                        TextInput::make('level_nama')
                            ->label('Level Nama')
                            ->maxLength(100)
                            ->required(),
                    ]),
            ]);
    }
}
