<?php

namespace Lieroes\OmnivaSDK\Domain\Repositories;

use Lieroes\OmnivaSDK\Application\DTOs\ShipmentResponseDTO;
use Lieroes\OmnivaSDK\Domain\Entities\Shipment;

interface ShipmentRepositoryInterface
{
    public function createShipment(Shipment $shipment): ShipmentResponseDTO;
}
