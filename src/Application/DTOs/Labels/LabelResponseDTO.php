<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\Labels;

class LabelResponseDTO {
    private array $failedAddressCards;
    private array $successAddressCards;

    public function __construct(array $failedAddressCards, array $successAddressCards) {
        $this->failedAddressCards = $failedAddressCards;
        $this->successAddressCards = $successAddressCards;
    }

    public static function fromArray(array $data): self {
        $failedAddressCards = array_map(
            fn($item) => new FailedAddressCardDTO($item['barcode'], $item['messageCode'] ?? null),
            $data['failedAddressCards'] ?? []
        );

        $successAddressCards = array_map(
            fn($item) => new SuccessAddressCardDTO($item['barcode'], $item['filedata'] ?? null),
            $data['successAddressCards'] ?? []
        );

        return new self($failedAddressCards, $successAddressCards);
    }

    public function getFailedAddressCards(): array {
        return $this->failedAddressCards;
    }

    public function getSuccessAddressCards(): array {
        return $this->successAddressCards;
    }
}
