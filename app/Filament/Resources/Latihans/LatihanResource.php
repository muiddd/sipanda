<?php

namespace App\Filament\Resources\Latihans;

use App\Filament\Resources\Latihans\Pages\CreateLatihan;
use App\Filament\Resources\Latihans\Pages\EditLatihan;
use App\Filament\Resources\Latihans\Pages\ListLatihans;
use App\Filament\Resources\Latihans\Schemas\LatihanForm;
use App\Filament\Resources\Latihans\Tables\LatihansTable;
use App\Models\Latihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class LatihanResource extends Resource
{
    protected static ?string $model = Latihan::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Akademik & Pembelajaran';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $recordTitleAttribute = 'question';

    protected static ?string $navigationLabel = 'Latihan Soal';

    protected static ?string $modelLabel = 'Latihan Soal';

    protected static ?string $pluralModelLabel = 'Latihan Soal';

    public static function form(Schema $schema): Schema
    {
        return LatihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LatihansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLatihans::route('/'),
            'create' => CreateLatihan::route('/create'),
            'edit' => EditLatihan::route('/{record}/edit'),
        ];
    }
}
