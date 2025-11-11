<?php

namespace App\Filament\Resources\WaktuPemilihans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WaktuPemilihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Periode')
                    ->default('PILKAHIM IF 2025')
                    ->required(),
                DateTimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required(),
                DateTimePicker::make('waktu_berakhir')
                    ->label('Waktu Berakhir')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
