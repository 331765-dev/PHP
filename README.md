# PHP

A minimal PHP application scaffold with a ready-to-use development environment.

## Requirements

- PHP >= 8.1 (developed against PHP 8.3)
- [Composer](https://getcomposer.org/)

## Getting started

```bash
composer install
composer start   # serves http://localhost:8000 from the public/ directory
```

Then open http://localhost:8000. A JSON health check is available at
http://localhost:8000/health.

## Running tests

```bash
composer test
```

## Project layout

```
public/       Web root (front controller: public/index.php)
src/          Application code (PSR-4 autoloaded as App\)
tests/        PHPUnit tests (PSR-4 autoloaded as Tests\)
.cursor/      Cloud Agent development environment (Dockerfile + environment.json)
```

## Cloud Agent environment

The `.cursor/` directory configures the Cursor Cloud Agent environment:

- `.cursor/Dockerfile` installs the PHP toolchain and Composer.
- `.cursor/environment.json` runs `composer install` and starts the PHP dev
  server on port 8000.
