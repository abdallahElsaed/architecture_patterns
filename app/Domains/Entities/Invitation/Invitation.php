<?php

namespace App\Domains\Entities\Invitation;

use InvalidArgumentException;
use App\Domains\Entities\Account\MobileNumber;

class Invitation
{
    private MobileNumber $invitedMobileNumber;
    private string $inviterId;

    // Private constructor
    private function __construct(MobileNumber $invitedMobileNumber, string $inviterId)
    {
        $this->invitedMobileNumber = $invitedMobileNumber;
        $this->inviterId = $inviterId;
    }

    // Static factory method
    public static function create(string $invitedMobileNumber, string $inviterId): self
    {
        return new self(
            MobileNumber::of($invitedMobileNumber),
            $inviterId
        );
    }

    public static function newInvitation(string $invitedMobileNumber, string $inviterId): self
    {
        return self::create($invitedMobileNumber, $inviterId);
    }

    // Getters
    public function getInvitedMobileNumber(): MobileNumber
    {
        return $this->invitedMobileNumber;
    }

    public function getInviterId(): string
    {
        return $this->inviterId;
    }

    // Equality check
    public function equals(self $other): bool
    {
        return $this->invitedMobileNumber->equals($other->getInvitedMobileNumber()) &&
                $this->inviterId === $other->getInviterId();
    }

    // String representation
    public function __toString(): string
    {
        return sprintf(
            'Invitation{invitedMobileNumber=%s, inviterId=%s}',
            $this->invitedMobileNumber,
            $this->inviterId
        );
    }
}
