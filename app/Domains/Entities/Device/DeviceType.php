<?php

namespace App\Domains\Entities\Device;

use InvalidArgumentException;

class DeviceType
{
    private string $value;

    // Allowed device types
    private const ALLOWED_TYPES = ['android', 'ios', 'web'];

    // Constructor with validation
    private function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    // Static factory method
    public static function create(string $value): self
    {
        $normalizedValue = strtolower($value);
        return new self($normalizedValue);
    }

    // Validation logic
    private function validate(string $value): void
    {
        if (!in_array($value, self::ALLOWED_TYPES, true)) {
            throw new InvalidArgumentException("Invalid device type: $value");
        }
    }

    // Getter for the value
    public function value(): string
    {
        return $this->value;
    }
}
