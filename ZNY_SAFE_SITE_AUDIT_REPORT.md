# ZNY SAFE SITE AUDIT REPORT

## Verdict
**YELLOW: works in code structure review, but external production validation is blocked from this environment and several production-specific requirements cannot be confirmed.**

## Executive Summary
A full read-only audit was performed against the available Laravel codebase and attempted against the live domain `https://znylogistic.com`. External HTTP validation was blocked by upstream `403 CONNECT tunnel failed` responses from this execution environment, so live page rendering checks (title/H1, broken assets, visible runtime errors) could not be fully verified. Static code review indicates locale routing, multilingual templates, and core forms are implemented, but production-only checks (custom `public_html/index.php`, server `.htaccess` state, real admin behavior, sitemap output) are unverified in this workspace.

## Critical Findings
### P0
- Unable to verify production webroot boot file `~/zehinliyoldash/public_html/index.php` because that path is not present in this environment.
- Unable to verify public route behavior and content on `https://znylogistic.com` due to network tunnel 403 for all audited URLs.

### P1
- Root route currently redirects to `/ru`, so EN home is not default at `/` (intentional or not should be confirmed).
- Expected production assets `public/images/logo-final.png` and `public/images/whatsapp-qr-final.png` are not present in this repository snapshot.
- `<title>` is globally set to company name in layout, which risks duplicate titles across pages.

## Public Routes Matrix
| URL | HTTP status | Final URL | title/H1 | Locale status | Asset status | Notes |
|---|---:|---|---|---|---|---|
| / | 403 | N/A | N/A | N/A | N/A | Live check blocked (CONNECT tunnel 403). |
| /ru | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /tm | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /contact | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /ru/contact | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /tm/contact | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /about | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /ru/about | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /tm/about | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /services | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /ru/services | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /tm/services | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /tracking | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /ru/tracking | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /tm/tracking | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /sitemap.xml | 403 | N/A | N/A | N/A | N/A | Live check blocked. |
| /robots.txt | 403 | N/A | N/A | N/A | N/A | Live check blocked. |

## Localization Findings
- Locale-aware route group exists for `ru`, `tm`, `en`; pages are localized using inline copy arrays plus `lang/*/messages.php` keys.
- Language switching logic strips existing locale segment and re-prepends selected locale; structurally sound.
- Potential inconsistency: most routes live under locale prefix, while separate public tracking endpoint is `/track` with English static template (`public-tracking.blade.php`).
- Root redirect is hardcoded to `/ru`; verify business intent for default language.

## Contact/WhatsApp Findings
- Contact page exists with localized copy, form, and WhatsApp CTA content.
- Expected production assets `logo-final.png` and `whatsapp-qr-final.png` are not found in `public/images` of this snapshot.
- Live verification of rendered logo/QR, WhatsApp link behavior, and Tawk overlap is blocked by external HTTP access limitation.

## Tracking Findings
- Localized tracking page has credential form and conditional shipment result sections.
- Graceful empty state appears implicit (form shown, results only when `$shipment` exists).
- Public tracking template (`/track`) is non-localized and English-only.
- Live runtime validation blocked.

## Assets Findings
- Available assets are mostly SVGs and premium variants; no `logo-final.png` or `whatsapp-qr-final.png` found.
- Pages rely heavily on external `images.pexels.com` URLs; production depends on third-party CDN availability.
- Tailwind is loaded from CDN (`https://cdn.tailwindcss.com`) in layout and public tracking template.
- No obvious hardcoded localhost URLs found in views/public/routes; defaults exist in config only.

## Mobile/Responsive Findings
- Static audit only (no browser automation used).
- Viewport meta tag is present.
- Layout uses responsive utility classes (`md:`, `lg:`, `xl:`) broadly.
- Floating WhatsApp button is fixed at bottom/right and may collide with chat widgets on small screens; exact collision not visually confirmed in live rendering.

## Admin/Filament Findings
- `/admin` and `/admin/site-settings` live checks both blocked externally (403 tunnel).
- Cannot confirm real redirect-to-login flow, Filament CSS/JS loading, or 500 errors on production from this environment.

## Sitemap/Robots/SEO Findings
- Live `sitemap.xml` and `robots.txt` fetch blocked (403 tunnel), so indexing directives and sitemap contents are unverified.
- SEO in Blade layout appears minimal: no page-specific dynamic title/meta description/canonical/hreflang/OpenGraph tags observed in base layout.
- Likely duplicate-title risk because title uses company name globally.

## Security/Exposure Findings
- No exposed runtime debug traces could be assessed from live pages due to HTTP access block.
- No obvious public backup files (`.zip`, `.sql`, `.bak`, `.old`, `.log`, public `.env`) found in local `public` directory scan.
- Symlinks found are confined to `node_modules/.bin` and are normal build-tool symlinks.

## Do Not Touch List
Do not change without explicit approval:
- `.env`
- `composer.json`
- `composer.lock`
- `bootstrap/app.php`
- `public/index.php`
- `public_html/index.php`
- `routes/*`
- `config/*`
- `vendor/*`
- `storage/*`
- DNS/SSL/domains/redirects/mail records
- `znylogistics.com` domain settings

## Recommended Fix Plan
### P0 safe fixes
1. **Path:** `~/zehinliyoldash/public_html/index.php`  
   **Issue:** Must be verified to reference `../app_laravel/vendor/autoload.php` and `../app_laravel/bootstrap/app.php`; unverified here.  
   **Risk:** Critical boot failure risk.  
   **Blade/public-only fix?:** No.  
   **Needs approval?:** Yes (production filesystem check).

2. **Path:** Production network/access layer (outside repo)  
   **Issue:** Audit environment cannot reach site (CONNECT 403), blocking functional verification.  
   **Risk:** Critical observability gap.  
   **Blade/public-only fix?:** No.  
   **Needs approval?:** Yes.

### P1 visual/SEO fixes
1. **Path:** `resources/views/layouts/app.blade.php`  
   **Issue:** Single global title; missing per-page title/meta/canonical/hreflang/OG basics.  
   **Risk:** Medium SEO quality risk.  
   **Blade/public-only fix?:** Yes.  
   **Needs approval?:** Recommended.

2. **Path:** `public/images/*` + view references  
   **Issue:** Expected final brand assets not found (`logo-final.png`, `whatsapp-qr-final.png`).  
   **Risk:** Medium brand consistency risk.  
   **Blade/public-only fix?:** Yes.  
   **Needs approval?:** Yes (asset source confirmation).

3. **Path:** `routes/web.php`  
   **Issue:** Default root locale forced to `/ru`; verify intended primary locale strategy.  
   **Risk:** Medium UX/SEO targeting risk.  
   **Blade/public-only fix?:** No (route change).  
   **Needs approval?:** Yes.

### P2 polish
1. **Path:** `resources/views/pages/public-tracking.blade.php`  
   **Issue:** English-only public tracking template may be inconsistent with EN/RU/TM locale strategy.  
   **Risk:** Low-medium consistency risk.  
   **Blade/public-only fix?:** Yes.  
   **Needs approval?:** Recommended.

2. **Path:** `resources/views/layouts/app.blade.php`  
   **Issue:** Floating WhatsApp control may overlap third-party chat widgets on mobile.  
   **Risk:** Low UX risk.  
   **Blade/public-only fix?:** Yes.  
   **Needs approval?:** Recommended.

## Safe Next Agent Command
```bash
cd ~/zehinliyoldash/app_laravel && php8.2 artisan route:list
```
(Use in FIX/verification phase only, still read-only.)
