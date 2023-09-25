<?php

namespace Test\Unit;

use BugReport\Database\PDOConnection;
use BugReport\Database\QueryBuilder;
use BugReport\Helpers\Config;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    /** @var QueryBuilder $queryBuilder */
    private $queryBuilder;

    protected function setUp(): void
    {
        $pdo = new PDOConnection(
            Config::get('database', 'pdo'),
            ['db_name' => 'bug_app_testing']
        );
        $this->queryBuilder = new QueryBuilder(
            $pdo->connect()
        );
        parent::setUp();
    }

    // public function testBindings()
    // {
    //     $query = $this->queryBuilder->where('id', 7)->where('reports_type', '>=', '100');
    //     self::assertIsArray($query->getPlaceholders());
    //     self::assertIsArray($query->getBindings());

    //     var_dump($query->getBindings(), $query->getPlaceholders());
    //     exit;
    // }

    public function testItCanCreateRecords()
    {
        $id = $this->queryBuilder->table('reports')->create($data);
        self::assertNotNull($id);
    }

    public function testItCanPerformRawQuery()
    {
        $result = $this->queryBuilder->raw("SELECT * FROM `repports`;");
        self::assertNotNull($result);
    }

    public function testItCanPerformSelectQuery()
    {
        $result = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id', 1);

        var_dump($result->query);
        exit;

        self::assertNotNull($result);
        self::assertSame(1, (int)$result->id);
    }

    public function testItCanPerformSelectQueryWithMultipleWhereClause()
    {
        $result = $this->queryBuilder
            ->select('*')
            ->where('id', 1)
            ->where('reports_type', '=', 'Report Type 1')
            ->first();

        self::assertNotNull($result);
        self::assertSame('Report Type 1', $result->report_type);
    }
}
