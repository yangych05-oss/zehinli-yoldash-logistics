<?php

namespace App\Filament\Resources\SiteCopyOverrideResource\Pages;

use App\Filament\Resources\SiteCopyOverrideResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteCopyOverride extends EditRecord
{
    protected static string $resource = SiteCopyOverrideResource::class;

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
