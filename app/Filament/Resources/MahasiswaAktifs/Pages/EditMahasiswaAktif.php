<?php

namespace App\Filament\Resources\MahasiswaAktifs\Pages;

use App\Filament\Resources\MahasiswaAktifs\MahasiswaAktifResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMahasiswaAktif extends EditRecord
{
    protected static string $resource = MahasiswaAktifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
