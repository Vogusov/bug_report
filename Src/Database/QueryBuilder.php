<?php

namespace BugReport\Database;

use BugReport\Contracts\DatabaseConnectionInterface;
use BugReport\Exception\NotFoundException;
use InvalidArgumentException;
use PhpParser\Node\Stmt\Break_;

class QueryBuilder
{
    use QueryTrait;

    protected $connection; //pdo or mysqli
    protected $table;
    protected $statement;
    protected $fields;
    protected $placeholders;
    protected $bindings; // name=? ['terry']
    protected $operation = self::DML_TYPE_SELECT; //dml - select, update, insert, delete
    public $query;

    const OPERATORS = ['=', '>=', '>', '<=', '<', '<>'];
    const PLACEHOLDER = '?';
    const COLUMNS = '*';
    const DML_TYPE_SELECT = 'SELECT';
    const DML_TYPE_INSERT = 'INSERT';
    const DML_TYPE_UPDATE = 'UPDATE';
    const DML_TYPE_DELETE = 'DELETE';

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    public function table($tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function where($column, $operator = self::OPERATORS[0], $value = null)
    {
        if (!in_array($operator, self::OPERATORS)) {
            if (is_null($value)) {
                $value = $operator;
                $operator = self::OPERATORS[0];
            } else {
                throw new NotFoundException('Operator is not valid', ['operator' => $operator]);
            }
        }
        $this->parseWhere([$column => $value], $operator);
        // $this->query = $this->prepare($this->getQuery($this->operation));
        $this->query = $this->getQuery($this->operation);

        return $this;
    }

    private function parseWhere(array $conditions, string $operator)
    {
        foreach ($conditions as $column => $value) {
            $this->placeholders[] = sprintf(
                '%s %s %s',
                $column,
                $operator,
                self::PLACEHOLDER
            );
            $this->bindings[] = $value;
        }
        return $this;
    }

    public function select(string $fields = self::COLUMNS)
    {
        $this->operation = self::DML_TYPE_SELECT;
        $this->fields = $fields;
        return $this;
    }

    public function getPlaceholders()
    {
        return $this->placeholders;
    }

    public function getBindings()
    {
        return $this->bindings;
    }
}
