<?php

namespace App\Filament\Resources\MahasiswaAktifs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MahasiswaAktifForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nim')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('angkatan')
                    ->required(),
            ]);
    }
}
