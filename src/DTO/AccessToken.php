<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\DTO;

use Carbon\Carbon;
use Helldar\Support\Concerns\Makeable;
use Helldar\Support\Facades\Helpers\Arr;
use Illuminate\Contracts\Support\Arrayable;

class AccessToken implements Arrayable
{
    use Makeable;

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

    public function getTerminalId(): string
    {
        return $this->terminal;
    }

    public function getExpiresIn(): Carbon
    {
        return Carbon::now()->addDay();
    }

    public function toArray(): array
    {
        return [
            'TerminalKey' => $this->getTerminalId(),
            'Token'       => $this->getAccessToken(),
        ];
    }

    protected function set(array $items)
    {
        foreach ($items as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
