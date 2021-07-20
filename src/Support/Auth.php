<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Support;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\AccessToken;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Facades\Cache as Facade;

class Auth
{
    public function accessToken(Client $client): array
    {
        return Facade::get($client, function (Client $client) {
            return $this->makeToken(
                $client->getClientId(),
                $client->getClientSecret(),
                $client->hasHash()
            );
        });
    }

    protected function makeToken(string $terminal, string $secret, bool $hash): AccessToken
    {
        return $hash
            ? $this->hashed($terminal, $secret)
            : $this->basic($terminal, $secret);
    }

    protected function basic(string $terminal, string $secret): AccessToken
    {
        return $this->headers($terminal, $secret);
    }

    protected function hashed(string $terminal, string $secret): AccessToken
    {
        $hash = $this->hash($terminal, $secret);

        return $this->headers($terminal, $hash);
    }

    protected function hash(string $terminal, string $secret): string
    {
        return hash('sha256', implode('', [
            'Password'    => $secret,
            'TerminalKey' => $terminal,
        ]));
    }

    protected function headers(string $terminal, string $access_token): AccessToken
    {
        return AccessToken::make(compact('terminal', 'access_token'));
    }
}
