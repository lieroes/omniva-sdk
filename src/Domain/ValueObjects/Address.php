<?php

namespace Lieroes\OmnivaSDK\Domain\ValueObjects;

class Address
{
    private string $country;
    private ?string $deliverypoint;
    private ?string $postcode;
    private ?string $street;
    private ?string $houseNo;
    private ?string $apartmentNo;
    private ?string $offloadPostcode;

    public function __construct(
        string  $country,
        ?string $deliverypoint = null,
        ?string $postcode = null,
        ?string $street = null,
        ?string $houseNo = null,
        ?string $apartmentNo = null,
        ?string $offloadPostcode = null
    )
    {
        $this->country = $country;
        $this->deliverypoint = $deliverypoint;
        $this->postcode = $postcode;
        $this->street = $street;
        $this->houseNo = $houseNo;
        $this->apartmentNo = $apartmentNo;
        $this->offloadPostcode = $offloadPostcode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getDeliverypoint(): ?string
    {
        return $this->deliverypoint;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
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
        return [
            'country' => $this->country,
            'deliverypoint' => $this->deliverypoint,
            'postcode' => $this->postcode,
            'street' => $this->street,
            'houseNo' => $this->houseNo,
            'apartmentNo' => $this->apartmentNo,
            'offloadPostcode' => $this->offloadPostcode,
        ];
    }
}
