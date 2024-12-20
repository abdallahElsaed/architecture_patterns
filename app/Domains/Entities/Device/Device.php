<?php

namespace App\Domains\Entities\Device;

use DateTime;

class Device
{
    private string $deviceId;
    private string $deviceType;
    private ?string $refreshToken;
    private ?string $fcmToken;
    private DateTime $lastAccessTime;

    // Private constructor
    private function __construct(
        string $deviceId,
        string $deviceType,
        DateTime $lastAccessTime,
        ?string $refreshToken = null,
        ?string $fcmToken = null
    ) {
        $this->deviceId = $deviceId;
        $this->deviceType = $deviceType;
        $this->lastAccessTime = $lastAccessTime;
        $this->refreshToken = $refreshToken;
        $this->fcmToken = $fcmToken;
    }

    // Static factory methods
    public static function of(string $deviceId, string $deviceType, ?string $refreshToken = null): self
    {
        return new self($deviceId, $deviceType, new DateTime(), $refreshToken);
    }

    public static function create(
        string $deviceId,
        string $deviceType,
        ?string $refreshToken = null,
        ?string $fcmToken = null,
        ?int $lastAccessTime = null
    ): self {
        $lastAccessTime = $lastAccessTime ? new DateTime("@$lastAccessTime") : new DateTime();
        return new self($deviceId, $deviceType, $lastAccessTime, $refreshToken, $fcmToken);
    }

    // Methods to update tokens
    public function updateRefreshToken(string $newRefreshToken): void
    {
        $this->refreshToken = $newRefreshToken;
        $this->lastAccessTime = new DateTime();
    }

    public function updateFCMToken(string $newFcmToken): void
    {
        $this->fcmToken = $newFcmToken;
        $this->lastAccessTime = new DateTime();
    }

    // Getters
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    public function getDeviceType(): string
    {
        return $this->deviceType;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function getFcmToken(): ?string
    {
        return $this->fcmToken;
    }

    public function getLastAccessTime(): DateTime
    {
        return clone $this->lastAccessTime;
    }
}
