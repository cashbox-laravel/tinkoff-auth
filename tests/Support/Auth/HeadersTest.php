<?php

declare(strict_types=1);

namespace Tests\Support\Auth;

use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth;
use Tests\TestCase;

class HeadersTest extends TestCase
{
    public function testBasic()
    {
        $auth = Auth::make($this->model(), $this->request(), false);

        $this->assertIsArray($auth->headers());

        $this->assertSame(['Accept' => 'application/json'], $auth->headers());
    }

    public function testHash()
    {
        $auth = Auth::make($this->model(), $this->request());

        $this->assertIsArray($auth->headers());

        $this->assertSame(['Accept' => 'application/json'], $auth->headers());
    }
}
