<?php

namespace Lieroes\OmnivaSDK\Application\Services;

use Exception;
use Lieroes\OmnivaSDK\Application\DTOs\Shipments\ShipmentResponseDTO;
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
     * @return ShipmentResponseDTO
     * @throws Exception
     */
    public function createB2CShipment(Shipment $shipment): ShipmentResponseDTO
    {
        $this->logger->info('Creating shipment', ['shipment' => $shipment->toArray()]);

        try {
            $shipment = $this->shipmentRepository->createB2CShipment($shipment);
            $this->logger->info('Shipment created successfully');

            return $shipment;
        } catch (Exception $e) {
            $this->logger->error('Failed to create shipment', ['error' => $e->getMessage()]);
            throw new Exception("Failed to create shipment: " . $e->getMessage());
        }
    }

    /**
     * @param Shipment $shipment
     * @return ShipmentResponseDTO
     * @throws Exception
     */
    public function createC2CShipment(Shipment $shipment): ShipmentResponseDTO
    {
        $this->logger->info('Creating shipment', ['shipment' => $shipment->toArray()]);

        try {
            $shipment = $this->shipmentRepository->createC2CShipment($shipment);
            $this->logger->info('Shipment created successfully');

            return $shipment;
        } catch (Exception $e) {
            $this->logger->error('Failed to create shipment', ['error' => $e->getMessage()]);
            throw new Exception("Failed to create shipment: " . $e->getMessage());
        }
    }

    /**
     * @param Shipment $shipment
     * @return ShipmentResponseDTO
     * @throws Exception
     */
    public function getLabel(Shipment $shipment, $barcode)
    {

        try {
            $shipment = $this->shipmentRepository->getLabel($shipment, $barcode);
            $this->logger->info('Shipment created successfully');

            return $shipment;
        } catch (Exception $e) {
            $this->logger->error('Failed to create shipment', ['error' => $e->getMessage()]);
            throw new Exception("Failed to create shipment: " . $e->getMessage());
        }
    }
}
