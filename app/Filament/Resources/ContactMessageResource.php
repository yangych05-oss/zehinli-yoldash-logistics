<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Contact Messages';
    protected static ?string $navigationGroup = 'Customer Relations';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Placeholder::make('sender')->content(fn (ContactMessage $record): string => $record->name),
            Placeholder::make('email')->content(fn (ContactMessage $record): string => $record->email),
            Placeholder::make('phone')->content(fn (ContactMessage $record): string => $record->phone ?: '—'),
            Placeholder::make('locale')->content(fn (ContactMessage $record): string => $record->locale ?: '—'),
            Placeholder::make('message')->content(
                fn (ContactMessage $record): HtmlString =>
                    new HtmlString(nl2br(e($record->message)))
            ),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('locale'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])->actions([
            Tables\Actions\ViewAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
