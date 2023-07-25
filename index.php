<?php

declare(strict_types=1);

use BugReport\Helpers\Config;
use BugReport\Helpers\App;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/Src/Exception/exception.php";

set_error_handler([new \BugReport\Exception\ExceptionHandler(), 'convertWarningsAndNoticesToException']);
set_exception_handler([new \BugReport\Exception\ExceptionHandler(), 'handle']);

// $config = Config::getFileContent('app');
// var_dump($config);

$db = new mysqli('dafbdb', 'root', 'root', 'bug');
