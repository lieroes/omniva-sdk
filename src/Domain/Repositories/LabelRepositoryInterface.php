<?php

namespace Lieroes\OmnivaSDK\Domain\Repositories;

use Lieroes\OmnivaSDK\Application\DTOs\Labels\LabelResponseDTO;
use Lieroes\OmnivaSDK\Application\DTOs\Labels\RequestLabelDTO;

interface LabelRepositoryInterface
{
    public function requestLabel(RequestLabelDTO $requestLabelDTO): LabelResponseDTO;
}
