<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting as SiteSettingModel;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $navigationGroup = 'Configuration';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $record = SiteSettingModel::query()->first();

        $this->form->fill($record?->toArray() ?? []);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Company & Contact')->schema([
                    TextInput::make('company_name')->required()->maxLength(255),
                    TextInput::make('company_domain')->maxLength(255),
                    TextInput::make('phone_primary')->required()->maxLength(50),
                    TextInput::make('phone_secondary')->maxLength(50),
                    TextInput::make('email_primary')->email()->required()->maxLength(255),
                    TextInput::make('email_secondary')->email()->maxLength(255),
                    TextInput::make('address')->maxLength(255),
                    TextInput::make('whatsapp_number')->required()->maxLength(50),
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
