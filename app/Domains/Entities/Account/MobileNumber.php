<?php

namespace App\Domains\Entities\Account;

use InvalidArgumentException;
use App\Domains\Validators\ValueValidator;

class MobileNumber
{
    private $value;
    private const MIN_LENGTH = 7;
    private const MAX_LENGTH = 15;
    private const MOBILE_PATTERN = '/^[0-9]*$/';

    public function __construct(string $value)
    {
        $valueValidator =new ValueValidator();
        $valueValidator->assertWithinRange($value, self::MIN_LENGTH, self::MAX_LENGTH, 'FullName');
        $valueValidator->assertValidFormat($value, self::MOBILE_PATTERN, 'MobileNumber');

        $this->value = $value;
    }

    public static function of(string $value): self
    {
        $modifiedNumber = $value;

        if (str_starts_with($modifiedNumber, '00')) {
            $modifiedNumber = substr($modifiedNumber, 2);
        }

        if (str_starts_with($modifiedNumber, '+')) {
            $modifiedNumber = substr($modifiedNumber, 1);
        }

        return new self($modifiedNumber);
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
