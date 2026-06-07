<?php

namespace App\Filament\Resources;

use App\Models\LearningSession;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\Summarizers\Sum;

class LearningSessionResource extends Resource
{
    protected static ?string $model = LearningSession::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Statistik & Monitoring';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Sesi Belajar';

    protected static ?string $modelLabel = 'Sesi Belajar';

    protected static ?string $pluralModelLabel = 'Sesi Belajar';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('materi.judul_materi')
                    ->label('Materi')
                    ->searchable()
                    ->default('-'),

                TextColumn::make('start_time')
                    ->label('Waktu Mulai')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('end_time')
                    ->label('Waktu Selesai')
                    ->dateTime()
                    ->sortable()
                    ->default('-'),

                TextColumn::make('duration')
                    ->label('Durasi')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state . ' Menit')
                    ->summarize(Sum::make()->label('Total Waktu')->formatStateUsing(fn ($state) => round($state / 60, 1) . ' Jam')),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'active' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'completed' => 'Selesai',
                        'active' => 'Aktif',
                        default => $state,
                    })
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'completed' => 'Selesai',
                        'active' => 'Aktif',
                    ]),
            ])
            ->actions([
                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Sesi Belajar')
                    ->modalDescription('Apakah Anda yakin ingin menghapus riwayat sesi belajar ini?'),
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
            'index' => \App\Filament\Resources\LearningSessionResource\Pages\ListLearningSessions::route('/'),
        ];
    }
}
