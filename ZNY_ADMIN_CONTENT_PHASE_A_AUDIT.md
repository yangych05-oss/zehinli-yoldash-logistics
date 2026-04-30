# ZNY ADMIN CONTENT PHASE A AUDIT

## Verdict
YELLOW

Reason: Core admin/settings infrastructure already exists and is usable for Phase B with low application risk, but asset delivery path and runtime verification are partially unknown in this environment (missing `php8.2`, unresolved production path mismatch).

## Existing Admin/Filament Structure
- Filament panel provider exists: `app/Providers/Filament/AdminPanelProvider.php`.
- Dedicated settings page exists: `app/Filament/Pages/SiteSettings.php` with save flow to `SiteSetting` model.
- Settings view exists: `resources/views/filament/pages/site-settings.blade.php`.
- Site settings are globally injected via `AppServiceProvider` and helper/cache support exists (`app/Support/SiteSettings.php`, `app/helpers.php`).
- `/admin/site-settings` route behavior is consistent with discovered `SiteSettings` page class.

## Existing Settings/Data Model
- `site_settings` table migration exists: `database/migrations/2026_04_18_000110_create_site_settings_table.php`.
- Model exists: `app/Models/SiteSetting.php`.
- Seeder exists: `database/seeders/SiteSettingSeeder.php`.
- Current settings schema appears focused on:
  - branding/domain/locale toggles,
  - contact fields (`phone_primary`, `phone_secondary`, `email_primary`, `email_secondary`, `address`),
  - WhatsApp fields (`whatsapp_number`, `whatsapp_link`),
  - map embed and timezone/lang defaults.
- Cache invalidation exists on save (`SiteSetting::saved(...)` clears `site_settings.payload`).

## Current Hardcoded Text/Image Sources
- **Hardcoded logo references** in layout:
  - `asset('images/logo-final.png')` for header/footer logo rendering.
  - OG image hardcoded to `https://znylogistic.com/images/logo-final.png`.
- **Hardcoded WhatsApp QR reference** in contact page:
  - `asset('images/whatsapp-qr-final.png')`.
- **Hardcoded page copy blocks** are present in Blade files:
  - `home.blade.php`, `about.blade.php`, `services.blade.php`, `contact.blade.php`, `tracking.blade.php` use locale arrays directly in templates.
- **Some dynamic settings already used**:
  - `site_setting('company_name')`, `site_setting('phone_primary')`, `site_setting('email_primary')`, `site_setting('address')`, `whatsapp_link()`.

## Current Asset/Storage State
- `public/images` exists and currently contains SVG branding assets and subfolders in this repo snapshot.
- `storage/app/public` and `public/storage` could not be verified from command output in this environment.
- `php8.2 artisan storage:link --help` could not be executed because `php8.2` binary is unavailable (`command not found`).
- Therefore symlink readiness is **Unknown** here; must be rechecked on target server runtime before Phase B rollout.

## Recommended Architecture
Preferred (applies here): **Extend existing `site_settings` model/page**, avoid introducing a parallel settings system.

Add settings keys/columns (single-record pattern):
- Images:
  - `logo_image`
  - `whatsapp_qr_image`
- Company/contact:
  - `company_name`
  - `whatsapp_number`
  - `whatsapp_link`
  - `contact_email`
  - `contact_phone`
  - `address_ru`
  - `address_tm`
- Footer:
  - `footer_text_ru`
  - `footer_text_tm`
- Hero:
  - `hero_title_ru`
  - `hero_title_tm`
  - `hero_subtitle_ru`
  - `hero_subtitle_tm`
- Page titles:
  - `about_title_ru`, `about_title_tm`
  - `services_title_ru`, `services_title_tm`
  - `contact_title_ru`, `contact_title_tm`
  - `tracking_title_ru`, `tracking_title_tm`
- SEO (optional but practical):
  - page-level title/description overrides per locale (only if implemented carefully without breaking existing canonical/hreflang behavior).

Implementation note:
- Keep fallback behavior in helper/support layer so existing pages remain functional if any new setting is null.
- Preserve existing SEO map as fallback baseline to avoid regressions.

## Required Phase B Files
Likely changes (targeted and minimal):
1. `app/Filament/Pages/SiteSettings.php` (new form fields, file upload components, validation).
2. `app/Models/SiteSetting.php` (extend `$fillable` / casts as needed).
3. `app/Support/SiteSettings.php` (new defaults + cache payload map).
4. `app/helpers.php` (fallback keys if helper-driven).
5. `database/migrations/*` (only for missing columns).
6. `resources/views/layouts/app.blade.php` (switch logo/OG image to setting-driven URL with fallback).
7. `resources/views/pages/contact.blade.php` (switch QR image to setting-driven URL with fallback).
8. Optional page text replacement touchpoints only if requested:
   - `resources/views/pages/home.blade.php`
   - `resources/views/pages/about.blade.php`
   - `resources/views/pages/services.blade.php`
   - `resources/views/pages/contact.blade.php`
   - `resources/views/pages/tracking.blade.php`
9. `public/sitemap.xml`: **no change in this phase** unless SEO URL strategy changes.

## Migration Needed?
Yes (for requested new keys as explicit columns), unless team chooses JSON key/value strategy inside existing table.

## Image Upload Strategy
Safest strategy:
1. Upload destination: `storage/app/public/site-settings`.
2. Persist relative paths in DB (e.g., `site-settings/logo-<hash>.png`).
3. Render with `Storage::url($path)` and fallback to legacy assets:
   - `images/logo-final.png`
   - `images/whatsapp-qr-final.png`
4. If `public/storage` symlink is missing:
   - recommend controlled `php artisan storage:link` **only after approval** and only on correct runtime.
5. Do **not** auto-overwrite `public/images/logo-final.png` or `public/images/whatsapp-qr-final.png`.
6. Do **not** perform full public sync.
7. If shared hosting symlink constraints exist (e.g., Beget limitation), fallback to controlled copy of only selected uploaded files into `public_html/images/site-settings` with timestamped backups and no mass copy.

## Text Editing Strategy
- Keep current Blade page structure and localization arrays as fallback.
- Introduce setting lookups only for explicitly requested editable fields first (titles/subtitles/footer/contact blocks).
- Use helper-based fallback chain:
  1) DB setting value
  2) existing hardcoded value
- This ensures no blank output and minimal SEO/content risk.

## Risks and Do-Not-Touch List
### P0 (avoid)
- `public_html/index.php`
- `public/index.php`
- `.env`
- `composer.json` / `composer.lock`
- `bootstrap/app.php`
- DNS/SSL/domain/mail infrastructure

### P1 (careful)
- Migrations / schema changes
- Routes
- Admin auth/panel provider

### P2 (safe)
- Blade reading existing settings with fallbacks
- Filament field additions on existing Site Settings page
- Image upload fields and storage path persistence

## Proposed Phase B Safe Implementation Command
Do not execute.

```bash
cd ~/zehinliyoldash/app_laravel && \
php artisan make:migration add_content_fields_to_site_settings_table --table=site_settings && \
# then implement: model fillable + support/helper fallbacks + Filament SiteSettings form fields + blade fallback wiring,
# run only targeted tests/static checks, and deploy without touching public_html/index.php or mass public sync.
```
