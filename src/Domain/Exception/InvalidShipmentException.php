<?php

namespace Lieroes\OmnivaSDK\Domain\Exception;

use Exception;

class InvalidShipmentException extends Exception
{
    public static function missingField(string $field): self
    {
        return new self("Missing required field: {$field}");
    }

    public static function invalidValue(string $field, string $reason): self
    {
        return new self("Invalid value for field: {$field}. Reason: {$reason}");
    }
}
