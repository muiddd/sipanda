<?php

namespace App\Filament\Resources\Kategoris\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\View\View;

class KategorisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kategori')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                    
                TextColumn::make('tanggal_publikasi')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                ->icon('heroicon-o-eye')
                ->label('Lihat'),
                EditAction::make()
                ->icon('heroicon-o-pencil')
                ->label('Ubah'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
