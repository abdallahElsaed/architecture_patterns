<?php

namespace App\Domains\Entities\Account;

use InvalidArgumentException;

class PhotoUrl
{
    private $value;
    private const URL_PATTERN = '/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_+.~#?&//=]*)/';

    public function __construct(string $value)
    {
        $this->validateNotEmpty($value);
        $this->validateFormat($value);
        $this->value = $value;
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function validateNotEmpty(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('The PhotoUrl cannot be empty.');
        }
    }

    private function validateFormat(string $value): void
    {
        if (!preg_match(self::URL_PATTERN, $value)) {
            throw new InvalidArgumentException(sprintf('Invalid PhotoUrl format: %s', $value));
        }
    }
}
