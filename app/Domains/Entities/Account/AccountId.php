<?php

namespace App\Domains\Entities\Account;

use Ramsey\Uuid\Uuid;

class AccountId
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public static function generate()
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getValue()
    {
        return $this->value;
    }
}
