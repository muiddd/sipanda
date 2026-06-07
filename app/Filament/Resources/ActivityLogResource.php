<?php

namespace App\Filament\Resources;

use App\Models\ActivityLog;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Statistik & Monitoring';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Log Aktivitas';

    protected static ?string $modelLabel = 'Log Aktivitas';

    protected static ?string $pluralModelLabel = 'Log Aktivitas';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.email')
                    ->label('Email User')
                    ->searchable(),

                TextColumn::make('aktivitas')
                    ->label('Aktivitas')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->searchable()
                    ->limit(100),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Log Aktivitas')
                    ->modalDescription('Apakah Anda yakin ingin menghapus log aktivitas ini?'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ActivityLogResource\Pages\ListActivityLogs::route('/'),
        ];
    }
}
