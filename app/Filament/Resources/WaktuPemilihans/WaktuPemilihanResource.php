<?php

namespace App\Filament\Resources\WaktuPemilihans;

use App\Filament\Resources\WaktuPemilihans\Pages\CreateWaktuPemilihan;
use App\Filament\Resources\WaktuPemilihans\Pages\EditWaktuPemilihan;
use App\Filament\Resources\WaktuPemilihans\Pages\ListWaktuPemilihans;
use App\Filament\Resources\WaktuPemilihans\Schemas\WaktuPemilihanForm;
use App\Filament\Resources\WaktuPemilihans\Tables\WaktuPemilihansTable;
use App\Models\WaktuPemilihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WaktuPemilihanResource extends Resource
{
    protected static ?string $model = WaktuPemilihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WaktuPemilihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaktuPemilihansTable::configure($table);
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
            'index' => ListWaktuPemilihans::route('/'),
            'create' => CreateWaktuPemilihan::route('/create'),
            'edit' => EditWaktuPemilihan::route('/{record}/edit'),
        ];
    }
}
