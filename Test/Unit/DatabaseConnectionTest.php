<?php

namespace Test\Unit;

use BugReport\Contracts\DatabaseConnectionInterface;
use PHPUnit\Framework\TestCase;
use BugReport\Database\PDOConnection;
use BugReport\Exception\MissingArgumentException;
use BugReport\Helpers\Config;

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


}
