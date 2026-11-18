<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentEventResource\Pages;
use App\Models\ShipmentEvent;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;

class ShipmentEventResource extends Resource
{
    protected static ?string $model = ShipmentEvent::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('shipment_id')
                ->relationship('shipment', 'tracking_code')
                ->required()
                ->searchable()
                ->preload(),
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
        ])->recordActions([
            EditAction::make(),
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
