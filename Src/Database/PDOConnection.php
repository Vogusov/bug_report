<?php

namespace BugReport\Database;

use BugReport\Contracts\DatabaseConnectionInterface;

class PDOConnection extends AbstractConnection implements DatabaseConnectionInterface
{

    const REQUIRED_CONNECTION_KEYS = [
        'driver',
        'host',
        'db_name',
        'db_username',
        'default_fetch'
    ];

    public function connect(): PDOConnection
    {
        return $this;
    }

    public function getConnection()
    {
    }
}
