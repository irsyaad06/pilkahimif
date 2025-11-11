<?php

namespace App\Filament\Resources\WaktuPemilihans\Pages;

use App\Filament\Resources\WaktuPemilihans\WaktuPemilihanResource;
use App\Models\WaktuPemilihan;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWaktuPemilihans extends ListRecords
{
    protected static string $resource = WaktuPemilihanResource::class;

    public function mount(): void
    {
        parent::mount();

        $record = WaktuPemilihan::first();
        if ($record) {
            $this->redirect(static::getResource()::getUrl('edit', ['record' => $record]));
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
