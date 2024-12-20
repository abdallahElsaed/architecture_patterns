<?php

namespace App\Domains\Validators;

use InvalidArgumentException;

class ValueValidator
{
    public static function assertNotEmpty(string $value, string $className): void
    {
        if (empty(trim($value))) {
            throw new InvalidArgumentException($className . " cannot be empty");
        }
    }

    public static function assertWithinRange(string $value, int $minLength, int $maxLength, string $className): void
    {
        $length = strlen($value);
        if ($length < $minLength || $length > $maxLength) {
            throw new InvalidArgumentException(
                $className . " must be between " . $minLength . " and " . $maxLength . " characters"
            );
        }
    }

    public static function assertValidFormat(string $value, string $pattern, string $className): void
    {
        if (!preg_match($pattern, $value)) {
            throw new InvalidArgumentException($className . " has an invalid format");
        }
    }
}
