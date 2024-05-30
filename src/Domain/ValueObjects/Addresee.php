<?php

namespace Lieroes\OmnivaSDK\Domain\ValueObjects;

class Addresee
{
    public function __construct(
        private string  $personName,
        private string  $contactEmail,
        private string  $contactMobile,
        private Address $address,
        private ?string $contactPhone = null,
        private ?string $companyName = null,
        private ?string $useCustomerCode = null,
    )
    {
    }

    public function getPersonName(): string
    {
        return $this->personName;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }

    public function getContactMobile(): string
    {
        return $this->contactMobile;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getContactPhone(): ?string
    {
        return $this->contactPhone;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function getUseCustomerCode(): ?string
    {
        return $this->useCustomerCode;
    }

    public function toArray(): array
    {
        return array_filter([
            'contactEmail' => $this->contactEmail,
            'contactMobile' => $this->contactMobile,
            'contactPhone' => $this->contactPhone,
            'personName' => $this->personName,
            'companyName' => $this->companyName,
            'useCustomerCode' => $this->useCustomerCode,
            'address' => $this->address->toArray(),
        ]);
    }
}
