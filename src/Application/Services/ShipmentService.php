<?php

namespace Lieroes\OmnivaSDK\Application\Services;

use Exception;
use Lieroes\OmnivaSDK\Application\DTOs\ShipmentResponseDTO;
use Lieroes\OmnivaSDK\Domain\Entities\Shipment;
use Lieroes\OmnivaSDK\Domain\Repositories\ShipmentRepositoryInterface;
use Monolog\Logger;

class ShipmentService
{
    /**
     * @param ShipmentRepositoryInterface $shipmentRepository
     * @param Logger $logger
     */
    public function __construct(
        private ShipmentRepositoryInterface $shipmentRepository,
        private Logger                      $logger
    )
    {
    }

    /**
     * @param Shipment $shipment
     * @return void
     * @throws Exception
     */
    public function createShipment(Shipment $shipment): ShipmentResponseDTO
    {
        $this->logger->info('Creating shipment', ['shipment' => $shipment->toArray()]);

        try {
            $shipment = $this->shipmentRepository->createShipment($shipment);
            $this->logger->info('Shipment created successfully');

            return $shipment;
        } catch (Exception $e) {
            $this->logger->error('Failed to create shipment', ['error' => $e->getMessage()]);
            throw new Exception("Failed to create shipment: " . $e->getMessage());
        }
    }
}
