<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\Shipments;

class FailedShipmentDTO {
    private string $barcode;
    private string $clientItemId;
    private string $messageCode;
    private string $message;

    public function __construct(
        string $barcode,
        string $clientItemId,
        string $messageCode,
        string $message
    ) {
        $this->barcode = $barcode;
        $this->clientItemId = $clientItemId;
        $this->messageCode = $messageCode;
        $this->message = $message;
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['barcode'],
            $data['clientItemId'],
            $data['messageCode'],
            $data['message']
        );
    }

    public function getBarcode(): string {
        return $this->barcode;
    }

    public function getClientItemId(): string {
        return $this->clientItemId;
    }

    public function getMessageCode(): string {
        return $this->messageCode;
    }

    public function getMessage(): string {
        return $this->message;
    }
}
