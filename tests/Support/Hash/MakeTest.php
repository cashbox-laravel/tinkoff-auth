<?php

declare(strict_types=1);

namespace Tests\Support\Hash;

use Helldar\CashierDriver\Tinkoff\Auth\Support\Hash;
use Tests\TestCase;

class MakeTest extends TestCase
{
    public function testMake()
    {
        $hash = Hash::make();

        $this->assertInstanceOf(Hash::class, $hash);
    }

    public function testConstruct()
    {
        $hash = new Hash();

        $this->assertInstanceOf(Hash::class, $hash);
    }
}
