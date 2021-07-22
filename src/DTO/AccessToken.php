<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\DTO;

use Carbon\Carbon;
use DateTimeInterface;
use Helldar\Contracts\Cashier\Authentication\Credentials;
use Helldar\Support\Facades\Helpers\Arr;

class AccessToken extends Base implements Credentials
{
    protected $access_token;

    protected $terminal;

    protected $map = [
        'TerminalKey' => 'terminal',
        'Token'       => 'access_token',
    ];

    public function __construct(array $items = [])
    {
        $items = Arr::renameKeysMap($items, $this->map);

        $this->set($items);
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function getClientId(): string
    {
        return $this->terminal;
    }

    public function getExpiresIn(): DateTimeInterface
    {
        return Carbon::now()->addDay();
    }

    public function toArray(): array
    {
        return [
            'TerminalKey' => $this->getClientId(),
            'Token'       => $this->getAccessToken(),
        ];
    }

    protected function set(array $items): void
    {
        foreach ($items as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
