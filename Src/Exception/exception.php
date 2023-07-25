<?php

set_error_handler([new \BugReport\Exception\ExceptionHandler(), 'convertWarningsAndNoticesToException']);
set_exception_handler([new \BugReport\Exception\ExceptionHandler(), 'handle']);