<?php

namespace App\Filament\Resources\WaktuPemilihans\Pages;

use App\Filament\Resources\WaktuPemilihans\WaktuPemilihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWaktuPemilihan extends EditRecord
{
    protected static string $resource = WaktuPemilihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
