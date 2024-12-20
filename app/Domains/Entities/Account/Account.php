<?php

namespace App\Domains\Entities\Account;

use App\Services\IJWTGenerator;
use App\Models\Device;
use DateTime;
use ArrayObject;

class Account
{
    private $mobileNumber;
    private $permissions;
    private $id;
    private $fullName;
    private $photoUrl;
    private $joinedDate;
    private $devices;
    private $blocked;

    public function __construct(
        $id,
        $mobileNumber,
        array $devices,
        array $permissions = null,
        $fullName = null,
        $photoUrl = null,
        $blocked = false,
        $joinedDate = null
    ) {
        $this->id = $id;
        $this->mobileNumber = $mobileNumber;
        $this->devices = new ArrayObject($devices);
        $this->permissions = $permissions ?: [Permission::VIEW()];
        $this->fullName = $fullName;
        $this->photoUrl = $photoUrl;
        $this->blocked = $blocked;
        $this->joinedDate = $joinedDate ?: new DateTime();
    }

    public static function newAccount($mobileNumber, $isAdmin, $deviceType, $deviceId)
    {
        $device = Device::of($deviceId, $deviceType);

        return new self(
            AccountId::generate(),
            MobileNumber::of($mobileNumber),
            [$device],
            [$isAdmin ? Permission::ADMIN() : Permission::VIEW()],
            null,
            null,
            false,
            new DateTime()
        );
    }

    public function authenticate(IJWTGenerator $jwtGenerator, $deviceId, $deviceType)
    {
        $usedDevice = $this->usedDevice($deviceId, $deviceType);

        $refreshToken = $jwtGenerator->generateRefreshToken($this, $usedDevice);
        $usedDevice->updateRefreshToken($refreshToken);

        $accessToken = $jwtGenerator->generateAccessToken($this, $usedDevice);

        return new Tokens($refreshToken, $accessToken);
    }

    private function usedDevice($deviceId, $deviceType)
    {
        $device = $this->getDevice($deviceId);
        if (!$device) {
            $device = Device::of($deviceId, $deviceType);
            $this->devices->append($device);
        }
        return $device;
    }

    private function getDevice($deviceId)
    {
        foreach ($this->devices as $device) {
            if ($device->getDeviceId()->value() === $deviceId) {
                return $device;
            }
        }
        return null;
    }

    public function getPermissions()
    {
        return clone $this->permissions;
    }

    public function getJoinedDate()
    {
        return clone $this->joinedDate;
    }

    public function getDevices()
    {
        return clone $this->devices;
    }
}
