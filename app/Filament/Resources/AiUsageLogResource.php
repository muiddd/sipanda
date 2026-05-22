<?php

namespace App\Filament\Resources;

use App\Models\AiUsageLog;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\Summarizers\Sum;

class AiUsageLogResource extends Resource
{
    protected static ?string $model = AiUsageLog::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationLabel = 'Tracking AI';

    protected static ?string $modelLabel = 'Log Penggunaan AI';

    protected static ?string $pluralModelLabel = 'Log Penggunaan AI';

    protected static \UnitEnum|string|null $navigationGroup = 'Statistik & Monitoring';

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
                TextColumn::make('materi.judul_materi')
                    ->label('Materi Terkait')
                    ->searchable()
                    ->default('-'),
                TextColumn::make('activity_type')
                    ->label('Tipe Aktivitas')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'summary' => 'success',
                        'quiz' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'summary' => '📝 Rangkuman',
                        'quiz' => '🎯 Latihan Soal',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('prompt_tokens')
                    ->label('Prompt Tokens')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('Total')),
                TextColumn::make('completion_tokens')
                    ->label('Comp. Tokens')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('Total')),
                TextColumn::make('total_tokens')
                    ->label('Total Tokens')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('Grand Total')),
                TextColumn::make('created_at')
                    ->label('Tanggal & Waktu')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('activity_type')
                    ->label('Tipe Aktivitas')
                    ->options([
                        'summary' => '📝 Rangkuman',
                        'quiz' => '🎯 Latihan Soal',
                    ]),
            ])
            ->actions([
                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Log AI')
                    ->modalDescription('Apakah Anda yakin ingin menghapus log penggunaan AI ini?'),
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
            'index' => \App\Filament\Resources\AiUsageLogResource\Pages\ListAiUsageLogs::route('/'),
        ];
    }
}
