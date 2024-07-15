<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\Shipments;

class ShipmentResponseDTO {
    private string $resultCode;
    private string $provider;
    private array $savedShipments;
    private array $failedShipments;

    public function __construct(
        string $resultCode,
        string $provider,
        array $savedShipments = [],
        array $failedShipments = []
    ) {
        $this->resultCode = $resultCode;
        $this->provider = $provider;
        $this->savedShipments = $savedShipments;
        $this->failedShipments = $failedShipments;
    }

    public static function fromArray(array $data): self {
        $savedShipments = array_map(
            fn($shipment) => SavedShipmentDTO::fromArray($shipment),
            $data['savedShipments'] ?? []
        );

        $failedShipments = array_map(
            fn($shipment) => FailedShipmentDTO::fromArray($shipment),
            $data['failedShipments'] ?? []
        );

        return new self(
            $data['resultCode'],
            $data['provider'],
            $savedShipments,
            $failedShipments
        );
    }

    public function getResultCode(): string {
        return $this->resultCode;
    }

    public function getProvider(): string {
        return $this->provider;
    }

    public function getSavedShipments(): array {
        return $this->savedShipments;
    }

    public function getFailedShipments(): array {
        return $this->failedShipments;
    }
}
