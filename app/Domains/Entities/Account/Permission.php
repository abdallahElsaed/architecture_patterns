<?php

namespace App\Domains\Entities\Account;

class Permission
{
    private const FULL_ACCESS = 'FULL_ACCESS';
    private const VIEW = 'VIEW';
    private const CREATE_CASES = 'CREATE_CASES';

    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function FULL_ACCESS(): self
    {
        return new self(self::FULL_ACCESS);
    }

    public static function VIEW(): self
    {
        return new self(self::VIEW);
    }

    public static function CREATE_CASES(): self
    {
        return new self(self::CREATE_CASES);
    }

    public static function fromString(string $permission): self
    {
        $constants = [self::FULL_ACCESS, self::VIEW, self::CREATE_CASES];
        if (!in_array($permission, $constants, true)) {
            throw new \InvalidArgumentException(sprintf('Invalid permission: %s', $permission));
        }
        return new self($permission);
    }

    public static function of(bool $isAdmin): self
    {
        return $isAdmin ? self::FULL_ACCESS() : self::VIEW();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
