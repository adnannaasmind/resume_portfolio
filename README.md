## Resume & Portfolio SaaS Backend

This repository contains a Laravel 12 API powering a resume/portfolio SaaS platform modeled after Codecanyon-style builders. **The backend is designed for both web and mobile applications** with full API support, CORS configuration, and mobile-optimized responses.

It includes:

- Token-based auth (Laravel Sanctum), profile management, password reset.
- Resume builder with duplication, completeness scoring, premium templates, PDF export with watermarks for free users, and shareable links.
- Portfolio builder with public URLs, social blocks, CTA content, and analytics counters.
- Pricing plans, subscriptions, payments (Stripe / PayPal ready), admin controls, SMTP & AI settings, plus installer tooling.
- AI cover-letter generation powered by OpenAI (or graceful fallback until configured).
- Multi-language scaffolding (English & Spanish) for templates and portfolio CTA text.

## Requirements

- PHP 8.2+
- Composer
- Node 20+ (only if you plan to run the optional Vite assets)
- SQLite/MySQL/PostgreSQL (default SQLite file is included)

## Quick start

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan app:install   # runs migrations, seeds, storage link
php artisan serve
```

Seeders provision:

- 8 resume templates (mix of free & premium flags)
- 3 subscription plans (Free, Pro, Business)
- Default SMTP/Payments/AI settings records
- Admin account → `admin@example.com` / `password`

## Environment variables

| Variable | Purpose |
| --- | --- |
| `APP_URL` | Used when generating share / checkout URLs |
| `STRIPE_PUBLIC_KEY`, `STRIPE_SECRET_KEY`, `STRIPE_WEBHOOK_SECRET` | Enable live Stripe checkout |
| `PAYPAL_CLIENT_ID`, `PAYPAL_CLIENT_SECRET`, `PAYPAL_ENV`, `PAYPAL_WEBHOOK_ID` | Enable PayPal |
| `OPENAI_API_KEY`, `OPENAI_MODEL` | Unlock AI cover-letter generation |
| `PDF_WATERMARK_TEXT` | Custom watermark for free exports |
| `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` | SMTP delivery |
| `CORS_ALLOWED_ORIGINS` | Comma-separated list of allowed origins (use `*` for mobile apps) |
| `SANCTUM_TOKEN_EXPIRATION` | Token expiration in minutes (default: 525600 = 1 year for mobile) |

## API overview

| Area | Endpoints (prefix `/api/v1`) |
| --- | --- |
| Auth | `POST auth/register`, `POST auth/login`, `POST auth/logout`, `GET auth/me`, `PUT auth/profile`, `PUT auth/preferences`, password reset helpers |
| Templates & Plans | `GET templates`, `GET plans` |
| Resumes | REST resource + duplication, publish/unpublish, completeness, PDF export with watermarking |
| Portfolios | REST resource + publish/unpublish, public slug endpoint |
| AI | `POST ai/cover-letter` |
| Payments | `POST payments/checkout`, `GET payments/history`, subscription lookup, Stripe/PayPal webhooks |
| Admin | `/admin` prefix for templates, plans, users, settings, dashboard stats (requires admin role) |

All authenticated routes require a Sanctum token sent via `Authorization: Bearer <token>`.

### Mobile App Support

The API is fully optimized for mobile applications:

- **Consistent JSON responses** with `success`, `data`, and `message` fields
- **Device tracking** via optional headers (`X-Device-Name`, `X-Device-ID`)
- **Long-lived tokens** (1 year default) suitable for mobile apps
- **CORS enabled** for cross-origin requests
- **Pagination support** with mobile-friendly metadata
- **File upload handling** optimized for mobile devices

See `API_DOCUMENTATION.md` for complete API reference including mobile-specific considerations.

## Installer & maintenance

- `php artisan app:install` – fresh install (migrate, seed, storage link).
- `php artisan migrate --seed` – update schema + seed.
- `php artisan queue:work` – run queued jobs if you extend the platform later.

## Testing / linting

```bash
composer test
vendor/bin/pint
```

## Next steps

- Plug in real Stripe/PayPal IDs (edit the seeded plans or update through admin API).
- Add your HTML/CSS templates under `resources/views/resumes` and expose preview URLs.
- Point DNS to the public portfolio routes (or later, add custom domains per roadmap).

Happy building!
