<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestResource\Pages;
use App\Models\Request as CrmRequest;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RequestResource extends Resource
{
    protected static ?string $model = CrmRequest::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('client_id')->relationship('client', 'name')->searchable()->preload(),
            Forms\Components\TextInput::make('subject')->required(),
            Forms\Components\TextInput::make('type')->required(),
            Forms\Components\Select::make('status')->options([
                'new' => 'New',
                'in_progress' => 'In Progress',
                'closed' => 'Closed',
            ])->required(),
            Forms\Components\Textarea::make('details'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('subject')->searchable(),
            Tables\Columns\TextColumn::make('client.name')->label('Client'),
            Tables\Columns\TextColumn::make('type'),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
}
