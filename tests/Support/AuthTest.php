<?php

namespace Tests\Support;

use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAccessTokenBasic()
    {
        $client = $this->client(false);

        $auth = $this->authentication()->accessToken($client);

        $this->assertIsArray($auth);
        $this->assertNotEmpty($auth);

        $this->assertSame($this->credentials(), $auth);
    }

    public function testAccessTokenHashed()
    {
        $client = $this->client();

        $auth = $this->authentication()->accessToken($client);

        $this->assertIsArray($auth);
        $this->assertNotEmpty($auth);

        $this->assertSame($this->credentialsHash(), $auth);
    }

    protected function authentication(): Auth
    {
        return new Auth();
    }
}
