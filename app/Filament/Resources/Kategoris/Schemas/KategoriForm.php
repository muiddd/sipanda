<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kategori')
                    ->description('Masukkan detail kategori materi pembelajaran Bahasa Indonesia di sini.')
                    ->schema([
                        TextInput::make('nama_kategori')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(30),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255),

                        RichEditor::make('deskripsi')
                            ->label('Deskripsi Kategori')
                            ->required()
                            ->toolbarButtons([
                                'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3',
                                'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                            ]),

                        TextInput::make('tanggal_publikasi')
                            ->label('Tanggal Publikasi')
                            ->type('datetime-local')
                            ->required(),
                    ])
                    ->columns(1),
            ]);
    }
}
