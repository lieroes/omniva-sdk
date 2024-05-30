<?php

namespace Lieroes\OmnivaSDK\Application\DTOs;

class SavedShipmentDTO {
    private string $barcode;
    private ?string $clientItemId;

    public function __construct(string $barcode, ?string $clientItemId = null) {
        $this->barcode = $barcode;
        $this->clientItemId = $clientItemId;
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['barcode'],
            $data['clientItemId'] ?? null
        );
    }

    public function getBarcode(): string {
        return $this->barcode;
    }

    public function getClientItemId(): ?string {
        return $this->clientItemId;
    }
}
