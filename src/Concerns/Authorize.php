<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Concerns;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Facades\Auth;
use Helldar\Contracts\Cashier\Authentication\Client as ClientContract;

/**
 * @mixin \Helldar\CashierDriver\Tinkoff\QrCode\Driver
 * @mixin \Helldar\Contracts\Cashier\Driver
 */
trait Authorize
{
    protected function content(array $data, bool $hash = true): array
    {
        $auth = $this->authorization($data, $hash);

        return array_merge($data, $auth);
    }

    protected function authorization(array $data, bool $hash = true): array
    {
        $auth = $this->authClientDTO($data, $hash);

        return Auth::getAccessToken($auth)->toArray();
    }

    protected function authClientDTO(array $data, bool $hash): ClientContract
    {
        /** @var \Helldar\Contracts\Cashier\Authentication\Client $auth */
        $auth = $this->request->getAuthentication();

        return Client::make()
            ->setClientId($auth->getClientId())
            ->setClientSecret($auth->getClientSecret())
            ->hash($hash)
            ->data($data);
    }
}
