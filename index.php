<?php

declare(strict_types=1);

use BugReport\Helpers\Config;
use BugReport\Helpers\App;
use BugReport\Logger\Logger;

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/Src/Exception/exception.php";

// set_error_handler([new \BugReport\Exception\ExceptionHandler(), 'convertWarningsAndNoticesToException']);
// set_exception_handler([new \BugReport\Exception\ExceptionHandler(), 'handle']);


$logger = new Logger();
$logger->log('emergency', 'test EMERGENCE level', ['DATATA' => 'LVCPVCPWYDPIVCYP']);
$logger->info('User ass created sucks', ['id' => 666]); 