<?php

declare(strict_types=1);

namespace Tests;

use App\App;
use PHPUnit\Framework\TestCase;

final class AppTest extends TestCase
{
    public function testInfoReportsOkStatus(): void
    {
        $info = (new App())->info();

        self::assertSame('ok', $info['status']);
        self::assertSame(App::VERSION, $info['version']);
        self::assertNotEmpty($info['php_version']);
    }

    public function testDefaultGreeting(): void
    {
        self::assertSame('Hello from PHP App!', (new App())->greeting());
    }

    public function testPersonalizedGreeting(): void
    {
        self::assertSame('Hello, Cursor, from PHP App!', (new App())->greeting('Cursor'));
    }
}
