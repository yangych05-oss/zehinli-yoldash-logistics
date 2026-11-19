<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteMediaItemResource\Pages;
use App\Models\SiteMediaItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SiteMediaItemResource extends Resource
{
    protected static ?string $model = SiteMediaItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website CMS';
    protected static ?string $navigationLabel = 'Photos and videos';
    protected static ?int $navigationSort = 2;

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
            Forms\Components\Section::make('Gallery item')
                ->description('Upload, replace or hide an individual slot. The published site keeps existing images until this record is published.')
                ->schema([
                    Forms\Components\TextInput::make('collection')
                        ->default('home-gallery')->required()->maxLength(64),
                    Forms\Components\Select::make('kind')->options([
                        'image'=>'Photo', 'video'=>'Video',
                    ])->required()->native(false)->live(),
                    Forms\Components\TextInput::make('slot')
                        ->numeric()->minValue(0)->maxValue(200)->required()
                        ->unique(
                            table: SiteMediaItem::class,
                            column: 'slot',
                            ignoreRecord: true,
                            modifyRuleUsing: fn (\Illuminate\Validation\Rules\Unique $rule, Forms\Get $get): \Illuminate\Validation\Rules\Unique => $rule
                                ->where('collection', $get('collection'))
                                ->where('kind', $get('kind')),
                        )
                        ->helperText('0–8 replace existing photos; 0–6 replace existing videos. Higher slots append.'),
                    Forms\Components\FileUpload::make('file_path')
                        ->label('Image or video file')
                        ->disk('public')->directory('cms/media')->visibility('public')
                        ->acceptedFileTypes(fn (Forms\Get $get): array => $get('kind') === 'video'
                            ? ['video/mp4', 'video/webm']
                            : ['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(fn (Forms\Get $get): int => $get('kind') === 'video' ? 51200 : 8192)->preserveFilenames(false)
                        ->required()->helperText('Maximum 50 MB in Filament; server upload limits may be lower.'),
                    Forms\Components\FileUpload::make('poster_path')
                        ->label('Video poster (optional)')
                        ->disk('public')->directory('cms/media/posters')->visibility('public')
                        ->image()->maxSize(4096)
                        ->visible(fn (Forms\Get $get): bool => $get('kind') === 'video')
                        ->required(fn (Forms\Get $get): bool => $get('kind') === 'video' && (bool) $get('is_published')),
                    Forms\Components\TextInput::make('caption_ru')->label('Caption / alt — Russian')->maxLength(255),
                    Forms\Components\TextInput::make('caption_tm')->label('Caption / alt — Turkmen')->maxLength(255),
                    Forms\Components\TextInput::make('caption_en')->label('Caption / alt — English')->maxLength(255)
                        ->required(fn (Forms\Get $get): bool => (bool) $get('is_published')),
                    Forms\Components\Toggle::make('is_published')
                        ->label('Published on website')->default(false),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('slot')->columns([
            Tables\Columns\TextColumn::make('collection')->searchable(),
            Tables\Columns\TextColumn::make('kind')->badge()->sortable(),
            Tables\Columns\TextColumn::make('slot')->sortable(),
            Tables\Columns\TextColumn::make('file_path')->label('File')->limit(55),
            Tables\Columns\TextColumn::make('caption_en')->label('English caption')->limit(40),
            Tables\Columns\IconColumn::make('is_published')->boolean(),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('kind')->options(['image'=>'Photo','video'=>'Video']),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteMediaItems::route('/'),
            'create' => Pages\CreateSiteMediaItem::route('/create'),
            'edit' => Pages\EditSiteMediaItem::route('/{record}/edit'),
        ];
    }
}
