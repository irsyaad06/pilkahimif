<?php

namespace App\Filament\Resources\Candidates\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CandidateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_paslon')
                    ->required(),
                FileUpload::make('foto')
                    ->required()
                    ->image()
                    ->directory('candidates'),
                Textarea::make('visi')
                    ->columnSpanFull(),
                Textarea::make('misi')
                    ->columnSpanFull(),
            ]);
    }
}
