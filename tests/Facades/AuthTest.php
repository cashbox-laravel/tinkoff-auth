<?php

namespace Tests\Facades;

use Helldar\CashierDriver\Tinkoff\Auth\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAccessTokenBasic()
    {
        $client = $this->client(false);

        $auth = Auth::accessToken($client);

        $this->assertIsArray($auth);
        $this->assertNotEmpty($auth);

        $this->assertSame($this->credentials(), $auth);
    }

    public function testAccessTokenHashed()
    {
        $client = $this->client();

        $auth = Auth::accessToken($client);

        $this->assertIsArray($auth);
        $this->assertNotEmpty($auth);

        $this->assertSame($this->credentialsHash(), $auth);
    }
}
