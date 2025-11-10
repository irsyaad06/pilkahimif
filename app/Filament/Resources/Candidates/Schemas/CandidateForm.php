<?php

namespace App\Filament\Resources\Candidates\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;

class CandidateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('calon_ketua')
                    ->required(),
                TextInput::make('calon_wakil_ketua')
                    ->required(),
                TextInput::make('nomor_urut')
                    ->required()
                    ->numeric(),
                FileUpload::make('foto')
                    ->required()
                    ->image()
                    ->directory('candidates')
                    ->disk('public'),
                TextInput::make('link_perkenalan')
                    ->required()
                    ->url() // otomatis wajib http/https
                    ->prefix('https://'),

                Textarea::make('visi')
                    ->columnSpanFull(),
                RichEditor::make('misi')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'link',
                        'redo',
                        'undo',
                    ]),

            ]);
    }
}
