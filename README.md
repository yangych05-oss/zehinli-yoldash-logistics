# ZNY LOGISTICS (Laravel 11)

Production-ready scaffold for:
- Corporate website (ru/tm/en)
- Shipment tracking page
- CRM for leads and clients
- Admin panel with Filament 3
- Contact + quote request forms (email notifications only)
- Roles: admin, manager, client (spatie/laravel-permission)

## Requirements
- PHP 8.2+
- Composer
- MySQL 8+
- Node.js 20+ (for full frontend asset build)

## Setup
1. Install dependencies:
   ```bash
   composer install
   ```
2. Create env:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Configure database in `.env`.
4. Run migrations and seed data:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
5. Install Filament assets and create storage link:
   ```bash
   php artisan filament:install
   php artisan storage:link
   ```
6. Run locally:
   ```bash
   php artisan serve
   ```

## Default seeded admin
- Email: `info@znylogistics.com`
- Password: `password`

## Main Routes
- `/ru`, `/tm`, `/en` - corporate pages
- `/{locale}/tracking` - shipment tracking
- `/{locale}/contact` - contact form POST
- `/{locale}/quote-request` - quote request POST
- `/admin` - Filament admin panel (after Filament install)

## Notes
- This repository includes full project structure and application code scaffold.
- In this execution environment, package download may be restricted; run installation in deployment environment.
