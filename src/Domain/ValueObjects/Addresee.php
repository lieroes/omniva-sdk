<?php

namespace Lieroes\OmnivaSDK\Domain\ValueObjects;

class Addresee
{
    public function __construct(
        private string  $contactEmail,
        private string  $contactMobile,
        private string  $contactPhone,
        private string  $personName,
        private string  $companyName,
        private string  $useCustomerCode,
        private Address $address,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'contactEmail' => $this->contactEmail,
            'contactMobile' => $this->contactMobile,
            'contactPhone' => $this->contactPhone,
            'personName' => $this->personName,
//            'companyName' => $this->companyName,
//            'useCustomerCode' => $this->useCustomerCode,
            'address' => $this->address->toArray(),
        ];
    }
}
