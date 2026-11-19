<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteMediaItemResource\Pages;
use App\Models\SiteMediaItem;
use App\Support\CmsMediaCatalog;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SiteMediaItemResource extends Resource
{
    protected static ?string $model = SiteMediaItem::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';
    protected static string|\UnitEnum|null $navigationGroup = 'Website CMS';
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
        // Keep the record and original file available for rollback.
        // A soft-deleted row still reserves its unique collection/kind/slot.
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Section::make('Photos and videos')
                ->description('Загружайте и заменяйте фотографии/видео по разделам сайта. Черновики не отображаются посетителям.')
                ->schema([
                    Forms\Components\Select::make('collection')
                        ->label('Раздел сайта')
                        ->options(CmsMediaCatalog::collections())
                        ->default('home-gallery')->required()->native(false)->live(),
                    Forms\Components\Select::make('kind')->options([
                        'image'=>'Photo', 'video'=>'Video',
                    ])->required()->native(false)->live(),
                    Forms\Components\Select::make('slot')
                        ->label('Позиция на странице')
                        ->options(fn (\Filament\Schemas\Components\Utilities\Get $get): array => CmsMediaCatalog::slots(
                            (string) $get('collection'),
                            (string) $get('kind'),
                        ))
                        ->searchable()->native(false)->required()
                        ->rules(fn (\Filament\Schemas\Components\Utilities\Get $get): array => [
                            \Illuminate\Validation\Rule::in(array_keys(CmsMediaCatalog::slots(
                                (string) $get('collection'),
                                (string) $get('kind'),
                            ))),
                        ])
                        ->unique(
                            table: SiteMediaItem::class,
                            column: 'slot',
                            ignoreRecord: true,
                            modifyRuleUsing: fn (\Illuminate\Validation\Rules\Unique $rule, \Filament\Schemas\Components\Utilities\Get $get): \Illuminate\Validation\Rules\Unique => $rule
                                ->where('collection', $get('collection'))
                                ->where('kind', $get('kind')),
                        )
                        ->helperText('Выберите готовую позицию. Публикация заменит её изображение; новые позиции добавят материал.'),
                    Forms\Components\FileUpload::make('file_path')
                        ->label('Image or video file')
                        ->disk('public')->directory('cms/media')->visibility('public')
                        ->acceptedFileTypes(fn (\Filament\Schemas\Components\Utilities\Get $get): array => $get('kind') === 'video'
                            ? ['video/mp4', 'video/webm']
                            : ['image/jpeg', 'image/png', 'image/webp'])
                        ->maxSize(fn (\Filament\Schemas\Components\Utilities\Get $get): int => $get('kind') === 'video' ? 51200 : 8192)->preserveFilenames(false)
                        ->required()->helperText('Maximum 50 MB in Filament; server upload limits may be lower.'),
                    Forms\Components\FileUpload::make('poster_path')
                        ->label('Video poster (optional)')
                        ->disk('public')->directory('cms/media/posters')->visibility('public')
                        ->image()->maxSize(4096)
                        ->visible(fn (\Filament\Schemas\Components\Utilities\Get $get): bool => $get('kind') === 'video')
                        ->required(fn (\Filament\Schemas\Components\Utilities\Get $get): bool => $get('kind') === 'video' && (bool) $get('is_published')),
                    Forms\Components\TextInput::make('caption_ru')->label('Caption / alt — Russian')->maxLength(255),
                    Forms\Components\TextInput::make('caption_tm')->label('Caption / alt — Turkmen')->maxLength(255),
                    Forms\Components\TextInput::make('caption_en')->label('Caption / alt — English')->maxLength(255)
                        ->required(fn (\Filament\Schemas\Components\Utilities\Get $get): bool => (bool) $get('is_published')),
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
        ])->recordActions([
            \Filament\Actions\EditAction::make(),
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
