<?php

namespace Lieroes\OmnivaSDK\Domain\ValueObjects;

class CustomerCode
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
