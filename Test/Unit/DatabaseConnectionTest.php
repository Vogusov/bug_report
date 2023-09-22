<?php

namespace Test\Unit;

use BugReport\Contracts\DatabaseConnectionInterface;
use BugReport\Database\MySQLiConnection;
use PHPUnit\Framework\TestCase;
use BugReport\Database\PDOConnection;
use BugReport\Exception\MissingArgumentException;
use BugReport\Helpers\Config;
use mysqli;

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
        $credentials = $this->getCredentials('pdo');
        $pdoHandler = (new PDOConnection($credentials))->connect();
        // self::assertNotNull($pdoHandler);
        self::assertInstanceOf(DatabaseConnectionInterface::class, $pdoHandler);
        return $pdoHandler;
    }

    /**  @depends testItCanConnectToDatabaseWithPdoApi */
    public function testItIsValidPdoConnection(DatabaseConnectionInterface $handler)
    {
        self::assertInstanceOf(\PDO::class, $handler->getConnection());
    }

    private function getCredentials(string $type) {
        return array_merge(
            Config::get('database', $type),
            ['db_name' => 'bug_app_testing']
        );
    }

    public function testItCanConnectToDatabaseWithMysqliApi()
    {
        $credentials = $this->getCredentials('mysqli');
        $pdoHandler = (new MySQLiConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class, $pdoHandler);
        return $pdoHandler;
    }

    /**  @depends testItCanConnectToDatabaseWithMysqliApi */
    public function testItIsValidMysqliConnection(DatabaseConnectionInterface $handler)
    {
        self::assertInstanceOf(\mysqli::class, $handler->getConnection());
    }


}
