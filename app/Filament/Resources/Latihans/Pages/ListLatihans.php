<?php

namespace App\Filament\Resources\Latihans\Pages;

use App\Filament\Resources\Latihans\LatihanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLatihans extends ListRecords
{
    protected static string $resource = LatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
