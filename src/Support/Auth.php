<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Support;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\AccessToken;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\Support\Facades\Helpers\Ables\Arrayable;

class Auth
{
    protected $terminal_key = 'TerminalKey';

    protected $password_key = 'Password';

    public function accessToken(Client $client): array
    {
        return $this->makeToken(
            $client->getClientId(),
            $client->getClientSecret(),
            $client->getData(),
            $client->hasHash()
        )->toArray();
    }

    protected function makeToken(string $terminal, string $secret, array $data, bool $hash): AccessToken
    {
        return $hash
            ? $this->hashed($terminal, $secret, $data)
            : $this->basic($terminal, $secret);
    }

    protected function basic(string $terminal, string $secret): AccessToken
    {
        return $this->items($terminal, $secret);
    }

    protected function hashed(string $terminal, string $secret, array $data): AccessToken
    {
        $hash = $this->hash($terminal, $secret, $data);

        return $this->items($terminal, $hash);
    }

    protected function hash(string $terminal, string $secret, array $data): string
    {
        $items = $this->prepare($terminal, $secret, $data);

        return hash('sha256', implode('', $items));
    }

    protected function prepare(string $terminal, string $secret, array $data): array
    {
        return Arrayable::of($data)
            ->set($this->terminal_key, $terminal)
            ->set($this->password_key, $secret)
            ->ksort()
            ->values()
            ->get();
    }

    protected function items(string $terminal, string $access_token): AccessToken
    {
        return AccessToken::make(compact('terminal', 'access_token'));
    }
}
