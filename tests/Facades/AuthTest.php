<?php

namespace Tests\Facades;

use Helldar\CashierDriver\Tinkoff\Auth\Facades\Auth;
use Helldar\Contracts\Cashier\Auth\Tokenable;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAccessTokenBasic()
    {
        $client = $this->client(false);

        $auth = Auth::getAccessToken($client);

        $this->assertInstanceOf(Tokenable::class, $auth);

        $this->assertIsArray($auth->toArray());
        $this->assertNotEmpty($auth->toArray());

        $this->assertSame($this->credentials(), $auth->toArray());
    }

    public function testAccessTokenHashed()
    {
        $client = $this->client();

        $auth = Auth::getAccessToken($client);

        $this->assertInstanceOf(Tokenable::class, $auth);

        $this->assertIsArray($auth->toArray());
        $this->assertNotEmpty($auth->toArray());

        $this->assertSame($this->credentialsHash(), $auth->toArray());
    }
}
