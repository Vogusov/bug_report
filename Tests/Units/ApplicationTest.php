<?php

namespace Test\Units;

use BugReport\Helpers\App;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testitCanGetInstanceOfApplication()
    {
        self::assertInstanceOf(App::class, new App());
    }
}
