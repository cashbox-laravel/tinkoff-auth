<?php

namespace Tests\Fixtures;

use Helldar\CashierDriver\Tinkoff\Auth\Concerns\Authorize;
use Helldar\CashierDriver\Tinkoff\Auth\DTO\Clientable;
use Helldar\Contracts\Cashier\Driver as DriverContract;
use Helldar\Contracts\Cashier\DTO\Config;
use Helldar\Contracts\Cashier\Exceptions\Exception;
use Helldar\Contracts\Cashier\Helpers\Status;
use Helldar\Contracts\Cashier\Resources\Request as RequestInstance;
use Helldar\Contracts\Cashier\Resources\Response;
use Helldar\Support\Concerns\Makeable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static DriverContract make(Config $config)
 */
class Driver implements DriverContract
{
    use Authorize;
    use Makeable;

    protected $config;

    /** @var RequestInstance */
    protected $request;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function setConcernRequest(RequestInstance $request): DriverContract
    {
        $this->request = $request;

        return $this;
    }

    public function getConcernContent(array $data, bool $hash = true): array
    {
        return $this->content($data, $hash);
    }

    public function getConcernAuthorization(array $data, bool $hash = true): array
    {
        return $this->authorization($data, $hash);
    }

    public function getConcernAuthDTO(array $data, bool $hash): Clientable
    {
        return $this->authClientDTO($data, $hash);
    }

    public function response(array $data, bool $mapping = true): Response
    {
        // TODO: Implement response() method.
    }

    public function model(Model $model): DriverContract
    {
        // TODO: Implement model() method.
    }

    public function statuses(): Status
    {
        // TODO: Implement statuses() method.
    }

    public function exception(): Exception
    {
        // TODO: Implement exception() method.
    }

    public function host(): string
    {
        // TODO: Implement host() method.
    }

    public function start(): Response
    {
        // TODO: Implement start() method.
    }

    public function check(): Response
    {
        // TODO: Implement check() method.
    }

    public function refund(): Response
    {
        // TODO: Implement refund() method.
    }
}
