# Versione B — Catalogo Giunti Psychometrics (Laravel)

🌐 [English](README.md) · [Español](README.es.md) · **Italiano**

Landing di catalogo di Giunti Psychometrics Italia con **Laravel 13 · Blade · Stylus · jQuery · Laravel Mix**, in italiano (predefinito) e spagnolo. Replica il design della Versione A con un'altra implementazione tecnica.

## Istruzioni di installazione

1. Installa **PHP 8.3 o superiore**, **Composer 2** e **Node.js 20 o superiore**.
2. Clona il repository ed entra nella cartella di questa versione:

   ```bash
   git clone <url-del-repository>
   cd <repository>/version-b
   ```

3. Installa le dipendenze e prepara l'ambiente (non serve un database):

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   npm install
   ```

## Comandi per l'esecuzione in sviluppo

In due terminali:

```bash
npm run watch        # compila Stylus e jQuery con Laravel Mix e osserva le modifiche
php artisan serve    # http://127.0.0.1:8000
```

Apri <http://127.0.0.1:8000>: reindirizza a `/it`; la versione spagnola è su `/es`.

| Comando | A cosa serve |
|---------|--------------|
| `npm run dev` | Compila gli asset una volta (sviluppo) |
| `npm run watch` | Compila e osserva le modifiche |
| `php artisan serve` | Server di sviluppo |
| `php artisan test` | Test (PHPUnit) |
| `./vendor/bin/pint` | Formattazione del codice PHP |

## Comando di build per la produzione

```bash
npm run production
composer install --no-dev --optimize-autoloader
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

## Versioni utilizzate

| Strumento | Versione |
|-----------|----------|
| PHP | 8.5.12 (minimo 8.3) |
| Composer | 2.11.2 |
| Node.js | 22.13.1 |
| npm | 10.9.2 |
| Laravel | 13.43 |
| Laravel Mix | 6.0.49 (con webpack fissato a 5.98.0) |

## Assunzioni e miglioramenti proposti

### Assunzioni

- I prodotti sono fittizi (nessun nome di test reale) e si trovano in `resources/data/catalog.php`, serviti da un repository (`App\Catalog\ProductRepository`); non c'è database.
- Sessione e cache usano file; non serve eseguire migrazioni.
- L'interattività (filtri, ricerca, validazione dei moduli, carrello, checkout, tema e lingua) è realizzata con jQuery; il carrello è salvato in `localStorage`.
- La ricerca nell'header funziona anche senza JavaScript (invia `?q=` alla home).
- Nessun gateway di pagamento: il checkout valida il modulo e simula l'ordine. Non vengono richiesti dati della carta.
- La palette è centralizzata in `resources/stylus/settings/palette.styl`; gli stili seguono BEM.
- Webpack è fissato a 5.98.0 perché le versioni recenti non funzionano con Laravel Mix 6.

### Miglioramenti proposti

- Migrare da Laravel Mix a Vite (lo standard attuale di Laravel) se il requisito sullo strumento di build lo consente.
- Salvare carrello e ordini lato server e collegare un provider di pagamento reale.
- Test nel browser (Laravel Dusk o Playwright) per filtri e checkout.
- Slug tradotti e `hreflang` per la SEO.
