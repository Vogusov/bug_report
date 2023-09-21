<?php

namespace BugReport\Database;

use BugReport\Exception\MissingArgumentException;

abstract class AbstractConnection
{

    protected $connection;

    protected $credentials;



    /**
     * Keys that we need for connection
     */
    const REQUIRED_CONNECTION_KEYS = [];



    abstract protected function parseCredentials(array $credentials): array;



    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
        if (!$this->credentialsHaveRequiredKeys($this->credentials)) {
            throw new MissingArgumentException(
                sprintf(
                    'Database connection credentials are not mapped correctly, required key: %s',
                    implode(',', static::REQUIRED_CONNECTION_KEYS)
                )
            );
        }
    }

    

    /**
     * Validation of credentials
     * @param array $credentials
     * @return bool
     */
    private function credentialsHaveRequiredKeys(array $credentials): bool
    {
        $matches = array_intersect(static::REQUIRED_CONNECTION_KEYS, array_keys($credentials));
        return count($matches) === count(static::REQUIRED_CONNECTION_KEYS);
    }
}
