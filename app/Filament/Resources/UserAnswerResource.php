<?php

namespace App\Filament\Resources;

use App\Models\UserAnswer;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class UserAnswerResource extends Resource
{
    protected static ?string $model = UserAnswer::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Statistik & Monitoring';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Riwayat Skor';

    protected static ?string $modelLabel = 'Riwayat Skor';

    protected static ?string $pluralModelLabel = 'Riwayat Skor';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Siswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('latihan.materi.judul_materi')
                    ->label('Materi')
                    ->searchable(),

                TextColumn::make('latihan.question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('answer')
                    ->label('Jawaban Siswa')
                    ->alignCenter(),

                TextColumn::make('is_correct')
                    ->label('Status')
                    ->badge()
                    ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn (bool $state): string => $state ? '✔ Benar' : '✘ Salah')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Waktu Pengerjaan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_correct')
                    ->label('Status')
                    ->options([
                        '1' => 'Benar',
                        '0' => 'Salah',
                    ]),
            ])
            ->actions([
                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Jawaban')
                    ->modalDescription('Apakah Anda yakin ingin menghapus riwayat jawaban ini?'),
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
            'index' => \App\Filament\Resources\UserAnswerResource\Pages\ListUserAnswers::route('/'),
        ];
    }
}
