<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static string|\UnitEnum|null $navigationGroup = 'Customer Relations';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('name')->label('Sender'),
            TextEntry::make('email')->label('Email'),
            TextEntry::make('phone')->label('Phone')->placeholder('—'),
            TextEntry::make('locale')->label('Language')->placeholder('—'),
            TextEntry::make('message')
                ->columnSpanFull()
                ->formatStateUsing(fn (?string $state): HtmlString =>
                    new HtmlString(nl2br(e($state ?? '')))
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
        ])->recordActions([
            ViewAction::make(),
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
