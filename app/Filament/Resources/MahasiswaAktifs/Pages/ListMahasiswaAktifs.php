<?php

namespace App\Filament\Resources\MahasiswaAktifs\Pages;

use App\Filament\Resources\MahasiswaAktifs\MahasiswaAktifResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMahasiswaAktifs extends ListRecords
{
    protected static string $resource = MahasiswaAktifResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         CreateAction::make(),
    //     ];
    // }
}
