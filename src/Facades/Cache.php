<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Facades;

use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Helldar\CashierDriver\Tinkoff\Auth\Support\Cache as Support;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array get(Client $client, callable $request)
 */
class Cache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Support::class;
    }
}
