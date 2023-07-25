<?php

declare(strict_types=1);

namespace BugReport\Exception;

use BugReport\Helpers\App;
use Throwable, ErrorException;

class ExceptionHandler
{



    public function handle(Throwable $exception)
    {
        $application = new App;

        if ($application->isDebugMode()) {
            var_dump($exception);
        } else {
            echo "Something went wrong, please try again";
        }
    }

    public function convertWarningsAndNoticesToException($severity, $message, $file, $line)
    {
        throw new ErrorException($message, $severity, $severity, $file, $line);
    }
}
