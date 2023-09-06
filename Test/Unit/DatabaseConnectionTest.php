<?php

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use BugReport\Database\PDOConnection;
use BugReport\Exception\MissingArgumentException;

class DatabaseConnectionTest extends TestCase
{
    public function testItThrowsMissingArgumentExceptionWithWrongCredentialKeys ()
    {
        self::expectException(MissingArgumentException::class);
        $credentials = [];
        $pdoHandler = new PDOConnection($credentials);
    }

    public function testItCanConnectToDatabaseWithPdoApi()
    {
        $credentials = [];
        $pdoHandler = (new PDOConnection($credentials))->connect();
        self::assertNotNull($pdoHandler);
    }


}
