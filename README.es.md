# Versión B — Catálogo Giunti Psychometrics (Laravel)

🌐 [English](README.md) · **Español** · [Italiano](README.it.md)

Landing de catálogo de Giunti Psychometrics Italia con **Laravel 13 · Blade · Stylus · jQuery · Laravel Mix**, en italiano (por defecto) y español. Replica el diseño de la Versión A con otra implementación técnica.

## Instrucciones de instalación

1. Instala **PHP 8.3 o superior**, **Composer 2** y **Node.js 20 o superior**.
2. Clona el repositorio y entra en la carpeta de esta versión:

   ```bash
   git clone <url-del-repositorio>
   cd <repositorio>/version-b
   ```

3. Instala las dependencias y prepara el entorno (no hace falta base de datos):

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   npm install
   ```

## Comandos para ejecutar en desarrollo

En dos terminales:

```bash
npm run watch        # compila Stylus y jQuery con Laravel Mix y observa cambios
php artisan serve    # http://127.0.0.1:8000
```

Abre <http://127.0.0.1:8000>: redirige a `/it`; la versión en español está en `/es`.

| Comando | Para qué sirve |
|---------|----------------|
| `npm run dev` | Compila los assets una vez (desarrollo) |
| `npm run watch` | Compila y observa cambios |
| `php artisan serve` | Servidor de desarrollo |
| `php artisan test` | Tests (PHPUnit) |
| `./vendor/bin/pint` | Formato del código PHP |

## Comando de build para producción

```bash
npm run production
composer install --no-dev --optimize-autoloader
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Versiones utilizadas

| Herramienta | Versión |
|-------------|---------|
| PHP | 8.5.12 (mínimo 8.3) |
| Composer | 2.11.2 |
| Node.js | 22.13.1 |
| npm | 10.9.2 |
| Laravel | 13.43 |
| Laravel Mix | 6.0.49 (con webpack fijado en 5.98.0) |

## Supuestos y mejoras propuestas

### Supuestos

- Los productos son ficticios (sin nombres de tests reales) y viven en `resources/data/catalog.php`, servidos por un repositorio (`App\Catalog\ProductRepository`); no hay base de datos.
- Sesión y caché usan archivos; no hace falta ejecutar migraciones.
- La interactividad (filtros, buscador, validación de formularios, carrito, checkout, tema e idioma) está hecha con jQuery; el carrito se guarda en `localStorage`.
- El buscador del header funciona también sin JavaScript (envía `?q=` a la home).
- No hay pasarela de pago: el checkout valida el formulario y simula el pedido. No se piden datos de tarjeta.
- La paleta está centralizada en `resources/stylus/settings/palette.styl`; los estilos siguen BEM.
- Webpack está fijado en 5.98.0 porque las versiones nuevas rompen Laravel Mix 6.

### Mejoras propuestas

- Migrar de Laravel Mix a Vite (el estándar actual de Laravel) si el requisito de build tool lo permite.
- Persistir carrito y pedidos en servidor y conectar un proveedor de pagos real.
- Tests de navegador (Laravel Dusk o Playwright) para filtros y checkout.
- Slugs traducidos y `hreflang` para SEO.
