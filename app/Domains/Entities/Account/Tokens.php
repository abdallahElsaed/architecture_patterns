<?php

namespace App\Domains\Entities\Account;

class Tokens
{
    private string $refreshToken;
    private string $accessToken;

    public function __construct(string $refreshToken, string $accessToken)
    {
        $this->refreshToken = $refreshToken;
        $this->accessToken = $accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
