<?php

namespace Lieroes\OmnivaSDK\Infrastructure\Repositories;

use Lieroes\OmnivaSDK\Application\DTOs\Shipments\ShipmentResponseDTO;
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

    public function createB2CShipment(Shipment $shipment): ShipmentResponseDTO
    {
        $url = 'https://omx.omniva.eu/api/v01/omx/shipments/business-to-client';

        return ShipmentResponseDTO::fromArray(
            $this->httpClient->post($url, $shipment->toArray())
        );
    }

    public function createC2CShipment(Shipment $shipment): ShipmentResponseDTO
    {
        $url = 'https://omx.omniva.eu/api/v01/omx/shipments/client-to-client';

        return ShipmentResponseDTO::fromArray(
            $this->httpClient->post($url, $shipment->toArray())
        );
    }

    public function getLabel(Shipment $shipment, $barcode)
    {
        $url = 'https://omx.omniva.eu/api/v01/omx/shipments/package-labels';

        $data = $shipment->toArray();
        $data['barcodes'] = [
            ['barcode' => $barcode]
        ];
        $data['sendAddressCardTo'] = 'EMAIL';
        $data['cardReceiverEmail'] = $data['shipments'][0]['senderAddressee']['contactEmail'];
        unset($data['shipments']);

        return $this->httpClient->post($url, $data);
    }
}
