<?php

namespace Tests\Support;

use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth;
use Helldar\Contracts\Cashier\Authentication\Credentials;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAccessTokenBasic()
    {
        $client = $this->client(false);

        $auth = $this->authentication()->accessToken($client);

        $this->assertInstanceOf(Credentials::class, $auth);

        $this->assertIsArray($auth->toArray());
        $this->assertNotEmpty($auth->toArray());

        $this->assertSame($this->credentials(), $auth->toArray());
    }

    public function testAccessTokenHashed()
    {
        $client = $this->client();

        $auth = $this->authentication()->accessToken($client);

        $this->assertInstanceOf(Credentials::class, $auth);

        $this->assertIsArray($auth->toArray());
        $this->assertNotEmpty($auth->toArray());

        $this->assertSame($this->credentialsHash(), $auth->toArray());
    }

    protected function authentication(): Auth
    {
        return new Auth();
    }
}
