<?php

/**
 * This file is part of the "cashbox/foundation" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://cashbox.city
 */

declare(strict_types=1);

namespace Cashbox\Tinkoff\Auth\Services;

use Carbon\Carbon;
use Cashbox\Core\Data\Signing\Token;
use Cashbox\Tinkoff\Auth\Constants\Keys;
use DateTimeInterface;
use DragonCode\Support\Facades\Helpers\Arr;

class Hash
{
    public static function get(string $clientId, string $clientSecret, array $data, bool $hash): Token
    {
        return $hash
            ? static::hashed($clientId, $clientSecret, $data)
            : static::basic($clientId, $clientSecret);
    }

    protected static function basic(string $clientId, string $clientSecret): Token
    {
        return static::data($clientId, $clientSecret);
    }

    protected static function hashed(string $clientId, string $clientSecret, array $data): Token
    {
        $hash = static::make($clientId, $clientSecret, $data);

        return static::data($clientId, $hash);
    }

    protected static function make(string $clientId, string $clientSecret, array $data): string
    {
        $items = static::resolve($clientId, $clientSecret, $data);

        return hash('sha256', $items);
    }

    protected static function resolve(string $clientId, string $clientSecret, array $data): string
    {
        return Arr::of($data)
            ->set(Keys::TERMINAL, $clientId)
            ->set(Keys::PASSWORD, $clientSecret)
            ->ksort()
            ->values()
            ->implode('')
            ->toString();
    }

    protected static function data(string $clientId, string $clientSecret, ?DateTimeInterface $expiresIn = null): Token
    {
        $expiresIn ??= Carbon::now()->addDay();

        return Token::from(compact('clientId', 'clientSecret', 'expiresIn'));
    }
}