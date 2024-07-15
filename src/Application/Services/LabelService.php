<?php

namespace Lieroes\OmnivaSDK\Application\Services;

use Exception;
use Lieroes\OmnivaSDK\Application\DTOs\Labels\LabelResponseDTO;
use Lieroes\OmnivaSDK\Application\DTOs\Labels\RequestLabelDTO;
use Lieroes\OmnivaSDK\Domain\Repositories\ShipmentRepositoryInterface;

class LabelService
{
    /**
     * @param ShipmentRepositoryInterface $shipmentRepository
     */
    public function __construct(
        private ShipmentRepositoryInterface $shipmentRepository,
    )
    {
    }

    /**
     * Request labels and return the response wrapped in a DTO.
     *
     * @param RequestLabelDTO $requestLabelDTO
     * @return LabelResponseDTO
     * @throws Exception
     */
    public function requestLabel(RequestLabelDTO $requestLabelDTO): LabelResponseDTO {
        try {
            $response = $this->shipmentRepository->requestLabel($requestLabelDTO);
            return LabelResponseDTO::fromArray($response);
        } catch (Exception $e) {
            throw new Exception("Failed to request label: " . $e->getMessage());
        }
    }
}
