<?php

namespace App\Filament\Resources\SiteCopyOverrideResource\Pages;

use App\Filament\Resources\SiteCopyOverrideResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteCopyOverride extends CreateRecord
{
    protected static string $resource = SiteCopyOverrideResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['updated_by'] = auth()->id();
        return $data;
    }
}
