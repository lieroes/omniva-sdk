<?php

namespace Lieroes\OmnivaSDK\Domain\ValueObjects;

class Address
{
    public function __construct(
        private string  $country,
        private ?string  $postcode,
        private ?string $deliveryPoint = null,
        private ?string $street = null,
        private ?string $houseNo = null,
        private ?string $apartmentNo = null,
        private ?string $offloadPostcode = null
    )
    {
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function getDeliverypoint(): ?string
    {
        return $this->deliveryPoint;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouseNo(): ?string
    {
        return $this->houseNo;
    }

    public function getApartmentNo(): ?string
    {
        return $this->apartmentNo;
    }

    public function getOffloadPostcode(): ?string
    {
        return $this->offloadPostcode;
    }

    public function toArray(): array
    {
        return array_filter([
            'country' => $this->country,
            'deliveryoint' => $this->deliveryPoint,
            'postcode' => $this->postcode,
            'street' => $this->street,
            'houseNo' => $this->houseNo,
            'apartmentNo' => $this->apartmentNo,
            'offloadPostcode' => $this->offloadPostcode,
        ]);
    }
}
