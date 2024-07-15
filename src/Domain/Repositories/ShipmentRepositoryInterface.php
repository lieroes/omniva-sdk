<?php

namespace Lieroes\OmnivaSDK\Domain\Repositories;

use Lieroes\OmnivaSDK\Application\DTOs\Shipments\ShipmentResponseDTO;
use Lieroes\OmnivaSDK\Domain\Entities\Shipment;

interface ShipmentRepositoryInterface
{
    public function createB2CShipment(Shipment $shipment): ShipmentResponseDTO;
    public function createC2CShipment(Shipment $shipment): ShipmentResponseDTO;
}
