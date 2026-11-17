# Version B — Giunti Psychometrics catalog (Laravel)

🌐 **English** · [Español](README.es.md) · [Italiano](README.it.md)

Catalog landing for Giunti Psychometrics Italia built with **Laravel 13 · Blade · Stylus · jQuery · Laravel Mix**, in Italian (default) and Spanish. It reproduces Version A's design with a different technical implementation.

## Installation

1. Install **PHP 8.3 or later**, **Composer 2** and **Node.js 20 or later**.
2. Clone the repository and enter this version's folder:

   ```bash
   git clone <repository-url>
   cd <repository>/version-b
   ```

3. Install dependencies and prepare the environment (no database needed):

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   npm install
   ```

## Development commands

In two terminals:

```bash
npm run watch        # builds Stylus and jQuery with Laravel Mix and watches changes
php artisan serve    # http://127.0.0.1:8000
```

Open <http://127.0.0.1:8000>: it redirects to `/it`; the Spanish version is at `/es`.

| Command | Purpose |
|---------|---------|
| `npm run dev` | Build assets once (development) |
| `npm run watch` | Build and watch for changes |
| `php artisan serve` | Development server |
| `php artisan test` | Tests (PHPUnit) |
| `./vendor/bin/pint` | PHP code style |

## Production build

```bash
npm run production
composer install --no-dev --optimize-autoloader
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Versions used

| Tool | Version |
|------|---------|
| PHP | 8.5.12 (minimum 8.3) |
| Composer | 2.11.2 |
| Node.js | 22.13.1 |
| npm | 10.9.2 |
| Laravel | 13.43 |
| Laravel Mix | 6.0.49 (webpack pinned to 5.98.0) |

## Assumptions and proposed improvements

### Assumptions

- Products are fictional (no real test names) and live in `resources/data/catalog.php`, served by a repository (`App\Catalog\ProductRepository`); there is no database.
- Sessions and cache use files; no migrations are needed.
- Interactivity (filters, search, form validation, cart, checkout, theme and language) is built with jQuery; the cart is stored in `localStorage`.
- The header search also works without JavaScript (it sends `?q=` to the home page).
- No payment gateway: checkout validates the form and simulates the order. No card data is requested.
- The palette is centralized in `resources/stylus/settings/palette.styl`; styles follow BEM.
- Webpack is pinned to 5.98.0 because newer versions break Laravel Mix 6.

### Proposed improvements

- Move from Laravel Mix to Vite (Laravel's current default) if the build-tool requirement allows it.
- Persist cart and orders server-side and integrate a real payment provider.
- Browser tests (Laravel Dusk or Playwright) for filters and checkout.
- Localized slugs and `hreflang` for SEO.
