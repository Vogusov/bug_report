<?php

namespace Tests\Units;

use BugReport\Database\PDOConnection;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{

    public function testItCanConnectToDatabaseWithPdoApi()
    {
        $pdoHandler = (new PDOConnection($credentials))->connect();
        self::assertNotNull($pdoHandler);
    }
}
