<?php

namespace App\Filament\Resources\Latihans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LatihansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('materi.judul_materi')
                    ->label('Materi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('options.jawaban_benar')
                    ->label('Jawaban Benar')
                    ->searchable()
                    ->default('-'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('materi_id')
                    ->label('Materi')
                    ->relationship('materi', 'judul_materi'),
            ])
            ->recordActions([
                EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->label('Ubah'),
                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
