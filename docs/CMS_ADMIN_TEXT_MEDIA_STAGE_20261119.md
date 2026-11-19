# ZNY LOGISTICS — CMS text and media editing (staged, NOT deployed)
Date: 2026-11-19

## Purpose
Extend existing Laravel 11 / Filament 3 administration without disrupting the live shipment CRM.
Introduce admin-only editors for localized site copy and per-slot photos/videos on the home gallery.

## What this branch adds
- `SiteCopyOverrideResource`: choose page (home/about/services/contact/tracking), locale (ru/tm/en), existing Blade field key, text and published status. Drafts are not visible publicly.
- `SiteMediaItemResource`: upload image or MP4/WebM to the Laravel `public` storage disk, optionally upload a video poster, maintain localized captions, choose gallery slot, and publish/unpublish. Editing an existing record replaces its file reference. Old files are intentionally retained for rollback.
- Schema migration with composite uniqueness (one override per page/locale/key and one media record per collection/kind/slot), timestamps and editor IDs.
- `CmsContent::copy()` overlays published plain text only on an existing string key. Public templates retain hardcoded localized fallbacks, and the function degrades safely if CMS tables do not yet exist.
- `CmsContent::media()` provides published media overrides by slot. Existing public gallery files remain defaults. The gallery Blade component is versioned in this PR, with support for appended slots.

## IMPORTANT: deployment blockers
**This branch has not been deployed to Beget.** Current live files are ahead of repository `main` (SEO and gallery hotfixes) and must be reconciled with this branch before any production file replacement. Do not deploy the branch as a full checkout over production.

1. Confirm `/zehinliyoldash/app_laravel` application and `/zehinliyoldash/public_html` document root; back up DB, Blade sources and gallery assets. Do not run destructive schema changes without rollback-tested backup.
2. Verify actual live Filament version and admin authentication. Beget phpMyAdmin currently asks for a separate password; which MySQL database drives the live Laravel installation has not been independently verified.
3. Verify the public-disk symlink: `/zehinliyoldash/public_html/storage` must resolve to the Laravel `storage/app/public` target. Check directory and file permissions and direct HTTPS response for a benign test image.
4. Check PHP `upload_max_filesize`, `post_max_size`, `max_file_uploads`, Filament Livewire temporary upload configuration and Beget request limits BEFORE video upload trials. Max app validation 50 MiB cannot override server limits.
5. Add strict composite uniqueness UI validation and end-to-end Filament authorization tests, including admin vs manager and direct URL access. Only users with `admin` role may access CMS resources.
6. Stage database migration and smoke tests in a disposable Laravel instance with a copy of the schema, not live data.
7. Review localized captions for content rights/accuracy and alt-text; verify photo/video MIME, size, poster and mobile layouts.
8. For a production deployment use atomic release or proven rollback; test five languages/paths and admin/login before and after. Existing published page content must never be replaced by drafts.
9. Confirm dynamic video source `Content-Type` and whether the CDN/cache correctly handles HTTP range requests (`206`) for large MP4s.
10. Sync actual live Blade template versions and CSS/assets into a release; do not accidentally reintroduce placeholder Russian hero text or older EN SEO data.

## CMS page text entry
Create an override only for an EXISTING string key in the page's `$content` array. Examples:
- home / ru / hero_title
- home / en / hero_text
- about / tm / title
- services / en / quote_text
- contact / ru / form_title
- tracking / en / support_text
- nested strings: `value_points.0` (zero-based array item)

Save with published OFF. Review and translate, then publish. Display is escaped using the current Blade `{{ }}` context; arbitrary HTML editing is deliberately disabled.

Current implementation targets the `$content` arrays. It does not automatically edit page layout, images outside the gallery, SEO title/description in the layout, or contact/tracking business data. Those need separate controlled interfaces.

## Image/video slots
Defaults on the live site: 9 gallery images (slots 0–8) and 7 videos (slots 0–6).
An override for existing slot changes only that slot; a new larger slot appends a card.
Video files should use MP4 for widest device support, with poster and descriptive captions in all three locales.
The `public` disk stores new uploads under `cms/media/`; the public site uses `/storage/cms/media/...`.
Original legacy media remain under `/media/zny/2026/`.

Delete in Filament uses soft deletion for media records; the unique slot remains reserved so it is preferable to **unpublish or edit an existing slot**. Permanent removal, trash restoration, media GC and historical versioning must be separately qualified before calling media lifecycle fully complete.

## Acceptance tests (must PASS before production)
- Unauthenticated/manager users cannot list/create/edit/delete either CMS resource.
- Admin can save draft copy; public site unchanged.
- Admin can publish a localized override; only matching locale/page/key changes; other locales unaffected.
- Admin can unpublish; original fallback returns immediately.
- Broken/missing tables and invalid keys do not produce HTTP 500.
- Admin can upload a JPEG/PNG/WebP image, with unique server filename and HTTPS 200.
- Admin can replace existing gallery slot, add a new slot and unpublish it, preserving other slots.
- MP4/WebM and poster are served with correct types; mobile playback is user-initiated and videos have `preload=none`.
- HTML/JS inserted into a text field is escaped, not executed.
- Attempts to submit unsafe paths or files are rejected.
- SEO: 15/15 localized routes, sitemap 15 URLs/60 hreflang, favicon and assets stay healthy.
- Use a real fresh admin session, verify session/CSRF and no cross-role access.

## Current verdict
**Code staged for review; not GREEN, not production certified.**
No MySQL migration, admin login, media upload or live CMS edit was performed.
