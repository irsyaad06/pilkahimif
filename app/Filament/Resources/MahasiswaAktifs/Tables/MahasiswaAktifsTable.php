<?php

namespace App\Filament\Resources\MahasiswaAktifs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MahasiswaAktifsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nim')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('angkatan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                //
            ]);
    }
}
