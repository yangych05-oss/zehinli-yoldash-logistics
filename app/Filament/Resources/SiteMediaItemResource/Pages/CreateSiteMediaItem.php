<?php

namespace App\Filament\Resources\SiteMediaItemResource\Pages;

use App\Filament\Resources\SiteMediaItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteMediaItem extends CreateRecord
{
    protected static string $resource = SiteMediaItemResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }
}
