<?php

namespace App\Filament\Resources\SiteCopyOverrideResource\Pages;

use App\Filament\Resources\SiteCopyOverrideResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteCopyOverrides extends ListRecords
{
    protected static string $resource = SiteCopyOverrideResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
