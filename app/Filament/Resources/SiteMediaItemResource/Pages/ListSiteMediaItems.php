<?php

namespace App\Filament\Resources\SiteMediaItemResource\Pages;

use App\Filament\Resources\SiteMediaItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteMediaItems extends ListRecords
{
    protected static string $resource = SiteMediaItemResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
