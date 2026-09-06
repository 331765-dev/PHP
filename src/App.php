<?php

declare(strict_types=1);

namespace App;

/**
 * Small application helper that exposes basic runtime information.
 *
 * This is intentionally lightweight — it exists to give the freshly
 * bootstrapped PHP environment something real to run and verify.
 */
final class App
{
    public const NAME = 'PHP App';
    public const VERSION = '0.1.0';

    /**
     * @return array<string, string>
     */
    public function info(): array
    {
        return [
            'name' => self::NAME,
            'version' => self::VERSION,
            'php_version' => PHP_VERSION,
            'status' => 'ok',
        ];
    }

    public function greeting(?string $name = null): string
    {
        $name = trim((string) $name);

        return $name === ''
            ? 'Hello from ' . self::NAME . '!'
            : sprintf('Hello, %s, from %s!', $name, self::NAME);
    }
}
