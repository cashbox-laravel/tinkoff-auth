<?php

namespace Tests\DTO;

use DateTimeInterface;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\AccessToken;
use Tests\TestCase;
use TypeError;

class AccessTokenTest extends TestCase
{
    public function testNew()
    {
        $instance = new AccessToken($this->credentials());

        $this->assertInstanceOf(AccessToken::class, $instance);
    }

    public function testMake()
    {
        $instance = AccessToken::make($this->credentials());

        $this->assertInstanceOf(AccessToken::class, $instance);
    }

    public function testRenamedKeys()
    {
        $keys = [
            'terminal'     => $this->terminal_key,
            'access_token' => $this->token,
        ];

        $instance = AccessToken::make($keys);

        $this->assertSame($this->credentials(), $instance->toArray());
    }

    public function testSameKeys()
    {
        $keys = [
            'TerminalKey' => $this->terminal_key,
            'Token'       => $this->token,
        ];

        $instance = AccessToken::make($keys);

        $this->assertSame($this->credentials(), $instance->toArray());
    }

    public function testBadKeys()
    {
        $keys = [
            'TerminalKey' => $this->terminal_key,
            'Token'       => $this->token,

            'foo' => 'Foo',
            'bar' => 'Bar',
        ];

        $instance = AccessToken::make($keys);

        $this->assertSame($this->credentials(), $instance->toArray());
    }

    public function testGetClientId()
    {
        $instance = AccessToken::make($this->credentials());

        $this->assertSame($this->terminal_key, $instance->getClientId());
    }

    public function testAccessToken()
    {
        $instance = AccessToken::make($this->credentials());

        $this->assertSame($this->token, $instance->getAccessToken());
    }

    public function testExpiresIn()
    {
        $instance = AccessToken::make($this->credentials());

        $this->assertInstanceOf(DateTimeInterface::class, $instance->getExpiresIn());
    }

    public function testToArray()
    {
        $instance = AccessToken::make($this->credentials());

        $this->assertSame($this->credentials(), $instance->toArray());
    }

    public function testEmpty()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(AccessToken::class . '::getTerminalId() must be');
        $this->expectExceptionMessage('type string, null returned');

        $instance = AccessToken::make();

        $instance->getClientId();
    }
}
