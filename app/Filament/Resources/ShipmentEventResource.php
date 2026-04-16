<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentEventResource\Pages;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShipmentEventResource extends Resource
{
    protected static ?string $model = ShipmentEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('shipment_id')
                ->options(Shipment::query()->pluck('tracking_code', 'id'))
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('status')->required(),
            Forms\Components\TextInput::make('location'),
            Forms\Components\DateTimePicker::make('event_time')->required(),
            Forms\Components\Textarea::make('description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('shipment.tracking_code')->label('Tracking code'),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('location'),
            Tables\Columns\TextColumn::make('event_time')->dateTime(),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShipmentEvents::route('/'),
            'create' => Pages\CreateShipmentEvent::route('/create'),
            'edit' => Pages\EditShipmentEvent::route('/{record}/edit'),
        ];
    }
}
