<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteCopyOverrideResource\Pages;
use App\Models\SiteCopyOverride;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SiteCopyOverrideResource extends Resource
{
    protected static ?string $model = SiteCopyOverride::class;
    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?string $navigationGroup = 'Website CMS';
    protected static ?string $navigationLabel = 'Page texts';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Localized page text')
                ->description('Draft by default. Publish only after reviewing the public fallback and its translation.')
                ->schema([
                    Forms\Components\Select::make('page')
                        ->options([
                            'home' => 'Home', 'about' => 'About', 'services' => 'Services',
                            'contact' => 'Contact', 'tracking' => 'Tracking',
                        ])->required()->native(false),
                    Forms\Components\Select::make('locale')
                        ->options(['ru' => 'Russian', 'tm' => 'Turkmen', 'en' => 'English'])
                        ->required()->native(false),
                    Forms\Components\TextInput::make('content_key')
                        ->label('Template field key')
                        ->helperText('Use an existing text key from the page template (e.g. hero_title, title, hero_text); nested: value_points.0')
                        ->required()->maxLength(160)
                        ->regex('/^[a-z][a-z0-9_]*(?:\.[a-z0-9_]+)*$/D'),
                    Forms\Components\Textarea::make('value')
                        ->label('Plain text replacement')->rows(6)->required()->maxLength(20000)
                        ->helperText('HTML is not interpreted. Blank values retain the original page text.'),
                    Forms\Components\Toggle::make('is_published')
                        ->label('Published on website')
                        ->default(false),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('updated_at', 'desc')->columns([
            Tables\Columns\TextColumn::make('page')->badge()->sortable()->searchable(),
            Tables\Columns\TextColumn::make('locale')->badge()->sortable(),
            Tables\Columns\TextColumn::make('content_key')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('value')->limit(70)->wrap(),
            Tables\Columns\IconColumn::make('is_published')->boolean(),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('page')->options([
                'home'=>'Home','about'=>'About','services'=>'Services','contact'=>'Contact','tracking'=>'Tracking',
            ]),
            Tables\Filters\SelectFilter::make('locale')->options(['ru'=>'RU','tm'=>'TM','en'=>'EN']),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteCopyOverrides::route('/'),
            'create' => Pages\CreateSiteCopyOverride::route('/create'),
            'edit' => Pages\EditSiteCopyOverride::route('/{record}/edit'),
        ];
    }
}
