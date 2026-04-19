<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make()
                            ->schema([
                                Section::make('Data Identitas')
                                    ->icon('heroicon-o-user')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Nama Lengkap')
                                            ->required()
                                            ->maxLength(100),
                                        TextInput::make('username')
                                            ->label('Username')
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(20),
                                        TextInput::make('email')
                                            ->label('Alamat Email')
                                            ->required()
                                            ->email()
                                            ->maxLength(100)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ])
                            ->columnSpan(2),

                        Group::make()
                            ->schema([
                                Section::make('Akses & Keamanan')
                                    ->icon('heroicon-o-lock-closed')
                                    ->schema([
                                        TextInput::make('password')
                                            ->label('Password')
                                            ->password()                                            
                                            ->maxLength(255),

                                        Select::make('level_id')
                                            ->label('Role / Level')
                                            ->relationship('level', 'level_nama')
                                            ->preload()
                                            ->required(),
                                    ]),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
