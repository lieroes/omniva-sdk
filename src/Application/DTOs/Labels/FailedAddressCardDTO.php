<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\Labels;

class FailedAddressCardDTO {
    private string $barcode;
    private ?string $messageCode;

    public function __construct(string $barcode, ?string $messageCode = null) {
        $this->barcode = $barcode;
        $this->messageCode = $messageCode;
    }

    public function getBarcode(): string {
        return $this->barcode;
    }

    public function getMessageCode(): ?string {
        return $this->messageCode;
    }
}
