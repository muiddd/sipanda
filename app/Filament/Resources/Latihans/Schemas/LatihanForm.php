<?php

namespace App\Filament\Resources\Latihans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LatihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Latihan Soal')
                    ->description('Masukkan pertanyaan dan pilihan jawaban.')
                    ->schema([
                        Select::make('materi_id')
                            ->label('Materi')
                            ->relationship('materi', 'judul_materi')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('question')
                            ->label('Pertanyaan')
                            ->required()
                            ->maxLength(65535),
                    ])
                    ->columns(1),

                Section::make('Pilihan Jawaban')
                    ->description('Masukkan pilihan ganda dan tentukan jawaban yang benar.')
                    ->schema([
                        TextInput::make('options.pilihan.0')
                            ->label('Pilihan A')
                            ->placeholder('Contoh: A. Kalimat utama di awal paragraf')
                            ->required(),

                        TextInput::make('options.pilihan.1')
                            ->label('Pilihan B')
                            ->placeholder('Contoh: B. Kalimat utama di akhir paragraf')
                            ->required(),

                        TextInput::make('options.pilihan.2')
                            ->label('Pilihan C')
                            ->placeholder('Contoh: C. Paragraf deskriptif')
                            ->required(),

                        TextInput::make('options.pilihan.3')
                            ->label('Pilihan D')
                            ->placeholder('Contoh: D. Paragraf naratif')
                            ->required(),

                        TextInput::make('options.jawaban_benar')
                            ->label('Jawaban Benar')
                            ->placeholder('Harus sama persis dengan salah satu pilihan di atas, contoh: A. Kalimat utama di awal paragraf')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
