<?php

declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

$config = \BugReport\Helpers\Config::getFileContent('app1');
var_dump($config);