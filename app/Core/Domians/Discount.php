<?php

namespace App\Core\Domains;

class Discount
{
    private string $code;
    private float $amount;
    // private int $type;

    const TYPE_FIXED = 1;
    const TYPE_PERCENTAGE = 2;

    public function __construct(string $code)
    {
        $this->code = $code;
        // $this->amount = $amount;
    }

    public static function create(string $code): self
    {
        return new self($code);
    }
}
