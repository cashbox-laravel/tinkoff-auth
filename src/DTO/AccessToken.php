<?php

namespace Helldar\CashierDriver\Tinkoff\Auth\DTO;

use Carbon\Carbon;
use Helldar\Support\Concerns\Makeable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class AccessToken implements Arrayable, Jsonable
{
    use Makeable;

    protected $access_token;

    protected $terminal;

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
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

    public function toJson($options = 0): string
    {
        return json_encode($this->toArray());
    }
}
