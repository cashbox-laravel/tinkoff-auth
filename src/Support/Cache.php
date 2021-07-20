<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\Support;

use DateTimeInterface;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\AccessToken;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache as Repository;

class Cache
{
    public function get(Client $client, callable $request): array
    {
        $key = $this->key($client);

        if (! $this->has($key)) {
            $response = $this->request($client, $request);

            $this->set($key, $response->getExpiresIn(), $response);

            return $response->toArray();
        }

        return $this->from($key);
    }

    protected function has(string $key): bool
    {
        return Repository::has($key);
    }

    protected function from(string $key): array
    {
        $cache = Repository::get($key);

        $decoded = json_decode($cache, true);

        return AccessToken::make($decoded)->toArray();
    }

    protected function set(string $key, DateTimeInterface $ttl, AccessToken $token): void
    {
        Repository::put($key, $token->toJson(), $ttl);
    }

    protected function request(Client $client, callable $request): AccessToken
    {
        return $request($client);
    }

    protected function key(Client $client): string
    {
        $client_id = $client->getClientId();

        return Collection::make([self::class, $client_id])
            ->map(static function ($item) {
                return md5($item);
            })->implode('::');
    }
}
