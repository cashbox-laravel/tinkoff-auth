<?php

namespace Tests\DTO;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetPaymentId()
    {
        $instance = Client::make()->data([
            'PaymentId' => $this->payment_id,
        ]);

        $this->assertSame($this->payment_id, $instance->getPaymentId());
    }

    public function testGetNullPaymentId()
    {
        $instance = Client::make();

        $this->assertNull($instance->getPaymentId());
    }

    public function testGetClientId()
    {
        $instance = Client::make();

        $instance->clientId($this->terminal_key);

        $this->assertSame($this->terminal_key, $instance->getClientId());
    }

    public function testGetClientSecret()
    {
        $instance = Client::make();

        $instance->clientSecret($this->token);

        $this->assertSame($this->token, $instance->getClientSecret());
    }

    public function testHasHash()
    {
        $instance = Client::make();

        $this->assertTrue($instance->hasHash());

        $instance->hash(false);

        $this->assertFalse($instance->hasHash());

        $instance->hash(true);

        $this->assertTrue($instance->hasHash());
    }

    public function testEmptyData()
    {
        $instance = Client::make();

        $this->assertIsArray($instance->getData());
        $this->assertEmpty($instance->getData());
    }

    public function testFilledData()
    {
        $instance = Client::make();

        $instance->data($this->credentials());

        $this->assertIsArray($instance->getData());
        $this->assertNotEmpty($instance->getData());

        $this->assertSame($this->credentials(), $instance->getData());
    }
}
