<?php

namespace Test\Unit;

use BugReport\Contracts\LoggerInterface;
use BugReport\Exception\InvalidLogLevelArgument;
use BugReport\Helpers\App;
use PHPUnit\Framework\TestCase;
use BugReport\Logger\Logger;
use BugReport\Logger\LogLevel;

class LoggerTest extends TestCase
{
    private $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger;
        parent::setUp();
    }

    public function testItImplementsTheLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, new Logger());
    }

    public function testItCanCreateDifferentTypesOfLogLevels()
    {
        $this->logger->info('Testing Info logs');
        $this->logger->error('Testing Error logs');
        $this->logger->log(LogLevel::ALERT, 'Testing Error logs');
        
        $app = new App;
        $filename = sprintf("%s/%s-%s.log", $app->getLogPath(), 'test', date('j.n.Y'));
        self::assertFileExists($filename);

        $contentLogFile = file_get_contents($filename);
        self::assertStringContainsString('Testing Info logs', $contentLogFile);
        self::assertStringContainsString('Testing Error logs', $contentLogFile);
        self::assertStringContainsString(LogLevel::ALERT, $contentLogFile);
        unlink($filename);
        self::assertFileDoesNotExist($filename);
    }

    public function testItThrowsInvalidLogLevelArgumentExceptionWhenGivenAWrongLogLevel() {
        self::expectException(InvalidLogLevelArgument::class);
        $this->logger->log('invalid', 'Testing invalid log level');
    }
}
