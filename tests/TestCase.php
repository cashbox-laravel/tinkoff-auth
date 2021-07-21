<?php

namespace Tests;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $terminal_key = '1234567890';

    protected $token = '5szqkybmwvjcgcb7';

    protected $hash = '16237a729273fbf1b5224906a40ea601664660b77aabcdaecab505b16ed0f545';

    protected $payment_id = '123456';

    protected function credentials(): array
    {
        return $this->auth($this->terminal_key, $this->token);
    }

    protected function credentialsHash(): array
    {
        return $this->auth($this->terminal_key, $this->hash);
    }

    protected function auth(string $terminal, string $secret): array
    {
        return [
            'TerminalKey' => $terminal,
            'Token'       => $secret,
        ];
    }

    protected function client(bool $hash = true): Client
    {
        return Client::make()
            ->clientId($this->terminal_key)
            ->clientSecret($this->token)
            ->hash($hash)
            ->data(['PaymentId' => $this->payment_id]);
    }
}
