<?php

namespace App\Filament\Resources\MahasiswaAktifs;

use App\Filament\Resources\MahasiswaAktifs\Pages\CreateMahasiswaAktif;
use App\Filament\Resources\MahasiswaAktifs\Pages\EditMahasiswaAktif;
use App\Filament\Resources\MahasiswaAktifs\Pages\ListMahasiswaAktifs;
use App\Filament\Resources\MahasiswaAktifs\Schemas\MahasiswaAktifForm;
use App\Filament\Resources\MahasiswaAktifs\Tables\MahasiswaAktifsTable;
use App\Models\MahasiswaAktif;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MahasiswaAktifResource extends Resource
{
    protected static ?string $model = MahasiswaAktif::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'MahasiswaAktif';

    public static function form(Schema $schema): Schema
    {
        return MahasiswaAktifForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MahasiswaAktifsTable::configure($table);
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
            'index' => ListMahasiswaAktifs::route('/'),
        ];
    }
}
