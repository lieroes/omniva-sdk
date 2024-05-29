<?php

namespace Lieroes\OmnivaSDK\Infrastructure\Repositories;

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

    public function createShipment(Shipment $shipment): void
    {
        $url = 'https://omx.omniva.eu/api/v01/omx/shipments/business-to-client';
        $data = $shipment->toArray();
        $this->httpClient->post($url, $data);
    }
}
