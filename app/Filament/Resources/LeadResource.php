<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('phone')->required(),
            Forms\Components\TextInput::make('origin')->required(),
            Forms\Components\TextInput::make('destination')->required(),
            Forms\Components\Textarea::make('cargo_details')->required(),
            Forms\Components\Select::make('status')->options([
                'new' => 'New',
                'contacted' => 'Contacted',
                'qualified' => 'Qualified',
                'won' => 'Won',
                'lost' => 'Lost',
            ])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('phone'),
            Tables\Columns\TextColumn::make('status')->badge(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
