<?php

declare(strict_types=1);

namespace BugReport\Helpers;

use DateTimeInterface, DateTime, DateTimeZone;

class App
{
    private array $config = [];

    public function __construct()
    {
        $this->config = Config::get('app');
    }

    public function isDebugMode(): bool
    {
        return $this->config['debug'] ?? false;
    }

    public function getEnviroment(): string
    {
        if (!isset($this->config['env'])) return 'production';
        return $this->isTestMode() ? 'test' : $this->config['env'];
    }

    public function getLogPath()
    {
        if (!isset($this->config['log_path'])) {
            throw new \Exception('Log path is not defined');
        }
        return $this->config['log_path'];
    }

    public function isRunningFromConsole(): bool
    {
        return php_sapi_name() === 'cli' || php_sapi_name() === 'phpbg';
    }

    public function getServerTime(): DateTimeInterface
    {
        return new DateTime('now', new DateTimeZone('Europe/Moscow'));
    }

    public function isTestMode()
    {
        if ($this->isRunningFromConsole() && defined('PHPUNIT_RUNNING') && PHPUNIT_RUNNING == true) {
            return true;
        }
        return false;
    }
}
