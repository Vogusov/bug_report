<?php

namespace BugReport\Contracts;

interface DatabaseConnectionInterface
{

    public function connect();
    public function getConnection();
}
