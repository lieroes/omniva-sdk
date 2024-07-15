<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\Labels;

class SuccessAddressCardDTO {
    private string $barcode;
    private ?string $filedata;

    public function __construct(string $barcode, ?string $filedata = null) {
        $this->barcode = $barcode;
        $this->filedata = $filedata;
    }

    public function getBarcode(): string {
        return $this->barcode;
    }

    public function getFiledata(): ?string {
        return $this->filedata;
    }
}
