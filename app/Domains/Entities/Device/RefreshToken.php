<?php

namespace App\Domains\Entities\Device;

use App\Domains\Validators\ValueValidator;

class RefreshToken
{
    private string $value;

    // Private constructor
    private function __construct(string $value)
    {
        (new ValueValidator())->assertNotEmpty($value, 'RefreshToken');

        $this->value = $value;
    }

    // Static factory method
    public static function create(string $value): self
    {
        return new self($value);
    }

    // Getter for the value
    public function getValue(): string
    {
        return $this->value;
    }

    // Equality check
    public function equals(self $other): bool
    {
        return $this->value === $other->getValue();
    }

    // String representation
    public function __toString(): string
    {
        return "RefreshToken{value='{$this->value}'}";
    }
}