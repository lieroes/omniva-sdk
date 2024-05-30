<?php

namespace Lieroes\OmnivaSDK\Infrastructure\Repositories;

use Lieroes\OmnivaSDK\Application\DTOs\ShipmentResponseDTO;
use Lieroes\OmnivaSDK\Domain\Entities\Shipment;
use Lieroes\OmnivaSDK\Domain\Repositories\ShipmentRepositoryInterface;
use Lieroes\OmnivaSDK\Infrastructure\Http\OmnivaHttpClient;

class ShipmentRepository implements ShipmentRepositoryInterface
{
    private OmnivaHttpClient $httpClient;

    public function __construct(OmnivaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function createShipment(Shipment $shipment): ShipmentResponseDTO
    {
        $url = 'https://omx.omniva.eu/api/v01/omx/shipments/business-to-client';

        return ShipmentResponseDTO::fromArray(
            $this->httpClient->post($url, $shipment->toArray())
        );
    }
}
