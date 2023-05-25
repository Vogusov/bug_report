<?php

declare(strict_types=1);
use BugReport\Helpers\Config;
use BugReport\Helpers\App;
require_once __DIR__ . "/vendor/autoload.php";

// $config = \BugReport\Helpers\Config::getFileContent('app1');
$app = new App();
echo $app->getServerTime()->format('Y.m.d H:i:s') . PHP_EOL;
echo $app->getEnviroment() . PHP_EOL;
echo $app->isDebugMode() . PHP_EOL;
echo $app->isRunningFromConsole() . PHP_EOL;
// var_dump($app);