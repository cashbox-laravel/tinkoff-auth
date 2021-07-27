<?php

namespace Tests\Support;

use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth;
use Helldar\Contracts\Cashier\Auth\Tokenable;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAccessTokenBasic()
    {
        $client = $this->client(false);

        $auth = $this->authentication()->getAccessToken($client);

        $this->assertInstanceOf(Tokenable::class, $auth);

        $this->assertIsArray($auth->toArray());
        $this->assertNotEmpty($auth->toArray());

        $this->assertSame($this->credentials(), $auth->toArray());
    }

    public function testAccessTokenHashed()
    {
        $client = $this->client();

        $auth = $this->authentication()->getAccessToken($client);

        $this->assertInstanceOf(Tokenable::class, $auth);

        $this->assertIsArray($auth->toArray());
        $this->assertNotEmpty($auth->toArray());

        $this->assertSame($this->credentialsHash(), $auth->toArray());
    }

    protected function authentication(): Auth
    {
        return new Auth();
    }
}
