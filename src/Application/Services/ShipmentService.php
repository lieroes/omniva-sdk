<?php

namespace Lieroes\OmnivaSDK\Application\Services;

use Exception;
use Lieroes\OmnivaSDK\Domain\Entities\Shipment;
use Lieroes\OmnivaSDK\Domain\Repositories\ShipmentRepositoryInterface;
use Monolog\Logger;

class ShipmentService
{
    public function __construct(
        private ShipmentRepositoryInterface $shipmentRepository,
        private Logger                      $logger
    )
    {
    }

    public
    function createShipment(Shipment $shipment): void
    {
        $this->logger->info('Creating shipment', ['shipment' => $shipment->toArray()]);

        try {
            $this->shipmentRepository->createShipment($shipment);
            $this->logger->info('Shipment created successfully');
        } catch (Exception $e) {
            $this->logger->error('Failed to create shipment', ['error' => $e->getMessage()]);
            throw new Exception("Failed to create shipment: " . $e->getMessage());
        }
    }
}
