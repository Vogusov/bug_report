<?php

declare(strict_types=1);

namespace BugReport\Helpers;

use BugReport\Exception\NotFoundException;

class Config
{
    public static function get(string $filename, string $key = null)
    {
        $fileContent = self::getFileContent($filename);
        if (is_null($key))
            return $fileContent;
        return $fileContent[$key] ?? [];
    }

    public static function getFileContent(string $filename): array
    {
        $fileContent = [];
        try {
            $path = realpath(sprintf(__DIR__ . "/../Configs/%s.php", $filename));
            if (file_exists($path)) {
                $fileContent = require $path;
            }
        } catch (\Throwable $th) {
            throw new NotFoundException(
                sprintf('The specified file: %s was not found', $filename)
            );
        }
        return $fileContent;
    }
}
