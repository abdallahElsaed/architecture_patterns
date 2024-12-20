<?php

namespace App\Domains\Entities\Account;

use InvalidArgumentException;
use App\Domains\Validators\ValueValidator;

class FullName
{
    private $value;
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 50;

    public function __construct(string $value)
    {
        (new ValueValidator())->assertWithinRange($value, self::MIN_LENGTH, self::MAX_LENGTH, 'FullName');;

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

}
