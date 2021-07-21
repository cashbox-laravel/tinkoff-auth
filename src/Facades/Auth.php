<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Facades;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth as Support;
use Helldar\Support\Facades\Facade;

/**
 * @method static array accessToken(Client $client)
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Support::class;
    }
}
