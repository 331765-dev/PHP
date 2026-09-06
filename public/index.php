<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\App;

$app = new App();

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Simple JSON health endpoint, handy for readiness checks.
if ($path === '/health') {
    header('Content-Type: application/json');
    echo json_encode($app->info(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    return;
}

$name = isset($_GET['name']) ? (string) $_GET['name'] : null;
$greeting = htmlspecialchars($app->greeting($name), ENT_QUOTES, 'UTF-8');
$info = $app->info();

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars(App::NAME, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root { color-scheme: light dark; }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            background: radial-gradient(1200px 600px at 50% -10%, #6d5efc22, transparent),
                        linear-gradient(160deg, #0f172a, #1e293b);
            color: #e2e8f0;
        }
        .card {
            width: min(560px, 92vw);
            padding: 2.5rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(8px);
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            background: #22c55e22;
            color: #4ade80;
            border: 1px solid #22c55e44;
        }
        h1 { margin: 1rem 0 0.5rem; font-size: 1.9rem; }
        p.greeting { font-size: 1.15rem; color: #cbd5e1; margin: 0 0 1.5rem; }
        dl {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.5rem 1.25rem;
            margin: 0;
            font-size: 0.95rem;
        }
        dt { color: #94a3b8; }
        dd { margin: 0; font-variant-numeric: tabular-nums; }
        a { color: #818cf8; }
        footer { margin-top: 1.75rem; font-size: 0.82rem; color: #64748b; }
    </style>
</head>
<body>
    <main class="card">
        <span class="badge">environment ok</span>
        <h1><?= htmlspecialchars(App::NAME, ENT_QUOTES, 'UTF-8') ?></h1>
        <p class="greeting"><?= $greeting ?></p>
        <dl>
            <dt>App version</dt><dd><?= htmlspecialchars($info['version'], ENT_QUOTES, 'UTF-8') ?></dd>
            <dt>PHP version</dt><dd><?= htmlspecialchars($info['php_version'], ENT_QUOTES, 'UTF-8') ?></dd>
            <dt>Status</dt><dd><?= htmlspecialchars($info['status'], ENT_QUOTES, 'UTF-8') ?></dd>
        </dl>
        <footer>
            Health check: <a href="/health">/health</a> &middot;
            Try <a href="/?name=Cursor">/?name=Cursor</a>
        </footer>
    </main>
</body>
</html>
