<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Facades;

use Helldar\CashierDriver\Tinkoff\Auth\Support\Auth as Support;
use Helldar\Contracts\Cashier\Auth\Client;
use Helldar\Contracts\Cashier\Auth\Tokenable;
use Helldar\Support\Facades\Facade;

/**
 * @method static Tokenable getAccessToken(Client $client)
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Support::class;
    }
}
