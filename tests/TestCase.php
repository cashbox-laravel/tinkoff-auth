<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $terminal_key = '1234567890';

    protected $token = '5szqkybmwvjcgcb7';

    protected function credentials(): array
    {
        return [
            'TerminalKey' => $this->terminal_key,
            'Token'       => $this->token,
        ];
    }
}
