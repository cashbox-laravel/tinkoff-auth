<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Concerns;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Facades\Auth;

/**
 * @mixin \Helldar\CashierDriver\Tinkoff\QrCode\Driver
 * @mixin \Helldar\Cashier\Services\Driver
 */
trait Authorize
{
    protected function content(array $data, bool $hash = true): array
    {
        $auth = $this->authorization($hash);

        return array_merge($data, $auth);
    }

    protected function authorization(array $data, bool $hash = true): array
    {
        $auth = $this->authDto($data, $hash);

        return Auth::accessToken($auth);
    }

    protected function authDto(array $data, bool $hash): Client
    {
        return Client::make()
            ->hash($hash)
            ->data($data)
            ->clientId($this->auth->getClientId())
            ->clientSecret($this->auth->getClientSecret());
    }
}
