<?php

namespace App\Filament\Resources\Materis\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MateriInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kategori_id')
                    ->numeric(),
                TextEntry::make('admin_id')
                    ->numeric(),
                TextEntry::make('judul_materi'),
                TextEntry::make('tanggal_publikasi')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
