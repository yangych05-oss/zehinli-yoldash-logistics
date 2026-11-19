<?php

namespace App\Filament\Resources\SiteMediaItemResource\Pages;

use App\Filament\Resources\SiteMediaItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteMediaItem extends EditRecord
{
    protected static string $resource = SiteMediaItemResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
