<?php

namespace Tests\Concerns;

use RuntimeException;
use Tests\TestCase;

class AuthorizeTest extends TestCase
{
    protected $use_hash;

    public function __get($name)
    {
        if ($name === 'auth') {
            return $this->client($this->use_hash);
        }

        throw new RuntimeException('Unknown property name.');
    }

    public function testContentBasic()
    {
        $this->use_hash = false;

        $content = $this->driver()->getConcernContent([
            'PaymentId' => $this->payment_id,
        ], $this->use_hash);

        $this->assertIsArray($content);
        $this->assertNotEmpty($content);

        $this->assertSame(array_merge([
            'PaymentId' => $this->payment_id,
        ], $this->credentials()), $content);
    }

    public function testContentHashed()
    {
        $this->use_hash = true;

        $content = $this->driver()->getConcernContent([
            'PaymentId' => $this->payment_id,
        ], $this->use_hash);

        $this->assertIsArray($content);
        $this->assertNotEmpty($content);

        $this->assertSame(array_merge([
            'PaymentId' => $this->payment_id,
        ], $this->credentialsHash()), $content);
    }

    public function testAuthorizationBasic()
    {
        $this->use_hash = false;

        $auth = $this->driver()->getConcernAuthorization([
            'PaymentId' => $this->payment_id,
        ], $this->use_hash);

        $this->assertIsArray($auth);
        $this->assertNotEmpty($auth);

        $this->assertSame($this->credentials(), $auth);
    }

    public function testAuthorizationHashed()
    {
        $this->use_hash = true;

        $auth = $this->driver()->getConcernAuthorization([
            'PaymentId' => $this->payment_id,
        ], $this->use_hash);

        $this->assertIsArray($auth);
        $this->assertNotEmpty($auth);

        $this->assertSame($this->credentialsHash(), $auth);
    }

    public function testAuthDtoBasic()
    {
        $this->use_hash = false;

        $instance = $this->driver()->getConcernAuthDTO([
            'PaymentId' => $this->payment_id,
        ], false);

        $this->assertSame($this->terminal_key, $instance->getClientId());
        $this->assertSame($this->token, $instance->getClientSecret());
        $this->assertSame($this->payment_id, $instance->getPaymentId());
    }

    public function testAuthDtoHashed()
    {
        $this->use_hash = true;

        $instance = $this->driver()->getConcernAuthDTO([
            'PaymentId' => $this->payment_id,
        ], true);

        $this->assertSame($this->terminal_key, $instance->getClientId());
        $this->assertSame($this->token, $instance->getClientSecret());
        $this->assertSame($this->payment_id, $instance->getPaymentId());
    }
}
