<?php

namespace App\Models\Device;

use InvalidArgumentException;
use App\Domains\Validators\ValueValidator;

class DeviceId
{
    private string $value;

    private const MIN_LENGTH = 15;
    private const MAX_LENGTH = 50;

    // Constructor with validation
    private function __construct(string $value)
    {
        (new ValueValidator())->assertWithinRange($value, self::MIN_LENGTH, self::MAX_LENGTH, 'FullName');;
        $this->value = $value;
    }

    // Static factory method
    public static function create(string $value): self
    {
        return new self($value);
    }

    // Getter for the value
    public function value(): string
    {
        return $this->value;
    }
}
