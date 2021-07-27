<?php

namespace Tests\DTO;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Clientable;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function testGetPaymentId()
    {
        $instance = Clientable::make()->data([
            'PaymentId' => $this->payment_id,
        ]);

        $this->assertSame($this->payment_id, $instance->getPaymentId());
    }

    public function testGetNullPaymentId()
    {
        $instance = Clientable::make();

        $this->assertNull($instance->getPaymentId());
    }

    public function testGetClientId()
    {
        $instance = Clientable::make();

        $instance->setClientId($this->terminal_key);

        $this->assertSame($this->terminal_key, $instance->getClientId());
    }

    public function testGetClientSecret()
    {
        $instance = Clientable::make();

        $instance->setClientSecret($this->token);

        $this->assertSame($this->token, $instance->getClientSecret());
    }

    public function testHasHash()
    {
        $instance = Clientable::make();

        $this->assertTrue($instance->hasHash());

        $instance->hash(false);

        $this->assertFalse($instance->hasHash());

        $instance->hash(true);

        $this->assertTrue($instance->hasHash());
    }

    public function testEmptyData()
    {
        $instance = Clientable::make();

        $this->assertIsArray($instance->getData());
        $this->assertEmpty($instance->getData());
    }

    public function testFilledData()
    {
        $instance = Clientable::make();

        $instance->data($this->credentials());

        $this->assertIsArray($instance->getData());
        $this->assertNotEmpty($instance->getData());

        $this->assertSame($this->credentials(), $instance->getData());
    }
}
