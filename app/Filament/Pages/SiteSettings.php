<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting as SiteSettingModel;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuration';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public function mount(): void
    {
        $record = SiteSettingModel::query()->first();

        $this->form->fill($record?->toArray() ?? []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([

                Section::make('Branding & Images')->schema([
                    FileUpload::make('logo_image')
                        ->label('Logo image')
                        ->disk('public')
                        ->directory('site-settings')
                        ->image()
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                        ->maxSize(2048),
                    FileUpload::make('whatsapp_qr_image')
                        ->label('WhatsApp QR image')
                        ->disk('public')
                        ->directory('site-settings')
                        ->image()
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                        ->maxSize(2048),
                ])->columns(2),
                Section::make('Company & Contact')->schema([
                    TextInput::make('company_name')->required()->maxLength(255),
                    TextInput::make('company_domain')->maxLength(255),
                    TextInput::make('phone_primary')->required()->maxLength(50),
                    TextInput::make('phone_secondary')->maxLength(50),
                    TextInput::make('email_primary')->email()->required()->maxLength(255),
                    TextInput::make('email_secondary')->email()->maxLength(255),
                    TextInput::make('address')->maxLength(255),
                    TextInput::make('whatsapp_number')->required()->maxLength(50),
                    TextInput::make('whatsapp_link')->label('WhatsApp direct link')->url()->maxLength(255),
                ])->columns(2),
                Section::make('Live Chat')->schema([
                    Toggle::make('live_chat_enabled')->default(true),
                    Select::make('live_chat_provider')
                        ->options([
                            'tawk' => 'Tawk',
                            'other' => 'Other',
                        ])
                        ->default('tawk')
                        ->native(false),
                    Textarea::make('live_chat_src')->rows(3),
                ])->columns(2),

                Section::make('Home Hero RU/TM')->schema([
                    Textarea::make('hero_title_ru')->label('Hero title RU')->rows(2),
                    Textarea::make('hero_title_tm')->label('Hero title TM')->rows(2),
                    Textarea::make('hero_subtitle_ru')->label('Hero subtitle RU')->rows(3),
                    Textarea::make('hero_subtitle_tm')->label('Hero subtitle TM')->rows(3),
                ])->columns(2),
                Section::make('Localized Footer & Address')->schema([
                    Textarea::make('footer_text_ru')->label('Footer text RU')->rows(3),
                    Textarea::make('footer_text_tm')->label('Footer text TM')->rows(3),
                    Textarea::make('address_ru')->label('Address RU')->rows(2),
                    Textarea::make('address_tm')->label('Address TM')->rows(2),
                ])->columns(2),
                Section::make('Public Content')->schema([
                    Textarea::make('footer_text')->rows(3),
                    TextInput::make('tracking_cta_text')->maxLength(255),
                    TextInput::make('contact_cta_text')->maxLength(255),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $payload = $this->form->getState();

        SiteSettingModel::query()->updateOrCreate(['id' => 1], $payload);

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
