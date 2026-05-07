<?php

namespace App\Filament\Resources\Materis\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MateriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Materi')
                    ->description('Masukkan detail materi pembelajaran Bahasa Indonesia di sini.')
                    ->schema([
                        TextInput::make('judul_materi')
                            ->label('Judul Materi')
                            ->required()
                            ->placeholder('Contoh: Teks Eksposisi Bab 1')
                            ->maxLength(255),

                        Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship('kategori', 'nama_kategori')
                            ->searchable()
                            ->preload()
                            ->required(),

                        RichEditor::make('konten_teks')
                            ->label('Isi Materi')
                            ->required()
                            ->columnSpanFull() 
                            ->toolbarButtons([
                                'blockquote', 'bold', 'bulletList', 'codeBlock', 'h2', 'h3',
                                'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                            ]),

                        TextInput::make('tanggal_publikasi')
                            ->label('Tanggal Publikasi')
                            ->type('datetime-local')
                            ->required(),
                        
                        Hidden::make('admin_id')
                            ->default(auth()->id()),
                    ])
                    ->columns(2), 
            ]);
    }
}
