<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Models\Shipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('tracking_code')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('public_access_code')->required()->password()->revealable(),
            Forms\Components\Select::make('client_id')->relationship('client', 'name')->searchable()->preload(),
            Forms\Components\TextInput::make('origin')->required(),
            Forms\Components\TextInput::make('destination')->required(),
            Forms\Components\Select::make('status')->options([
                'registered' => 'Registered',
                'in_transit' => 'In Transit',
                'arrived' => 'Arrived',
                'delivered' => 'Delivered',
            ])->required(),
            Forms\Components\TextInput::make('current_location'),
            Forms\Components\DateTimePicker::make('eta'),
            Forms\Components\Textarea::make('details'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('tracking_code')->searchable(),
            Tables\Columns\TextColumn::make('client.name')->label('Client'),
            Tables\Columns\TextColumn::make('origin'),
            Tables\Columns\TextColumn::make('destination'),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('current_location'),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
        ];
    }
}
