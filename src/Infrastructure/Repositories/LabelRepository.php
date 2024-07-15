<?php

namespace Lieroes\OmnivaSDK\Infrastructure\Repositories;

use Lieroes\OmnivaSDK\Application\DTOs\Labels\LabelResponseDTO;
use Lieroes\OmnivaSDK\Application\DTOs\Labels\RequestLabelDTO;
use Lieroes\OmnivaSDK\Domain\Repositories\LabelRepositoryInterface;
use Lieroes\OmnivaSDK\Infrastructure\Http\OmnivaHttpClient;

class LabelRepository implements LabelRepositoryInterface
{
    private OmnivaHttpClient $httpClient;

    public function __construct(OmnivaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function requestLabel(RequestLabelDTO $requestLabelDTO): LabelResponseDTO {
        $url = 'https://omx.omniva.eu/api/v01/omx/shipments/package-labels';

        return LabelResponseDTO::fromArray(
            $this->httpClient->post($url, $requestLabelDTO->toArray())
        );
    }
}
