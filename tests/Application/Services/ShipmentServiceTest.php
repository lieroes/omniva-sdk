<?php

namespace Lieroes\OmnivaSDK\Tests\Application\Services;

use Lieroes\OmnivaSDK\Application\DTOs\Labels\LabelResponseDTO;
use Lieroes\OmnivaSDK\Application\DTOs\Labels\RequestLabelDTO;
use Lieroes\OmnivaSDK\Application\Services\ShipmentService;
use Lieroes\OmnivaSDK\Domain\Repositories\ShipmentRepositoryInterface;
use Lieroes\PHPUnit\Framework\TestCase;

class ShipmentServiceTest extends TestCase {
    public function testRequestLabelSuccess() {
        $requestLabelDTO = new RequestLabelDTO(
            'customerCode123',
            ['barcode1', 'barcode2'],
            'RESPONSE'
        );
        $repository = $this->createMock(ShipmentRepositoryInterface::class);

        $response = [
            'failedAddressCards' => [],
            'successAddressCards' => [
                ['barcode' => 'barcode1', 'filedata' => 'base64data1'],
                ['barcode' => 'barcode2', 'filedata' => 'base64data2']
            ]
        ];

        $repository->expects($this->once())
            ->method('requestLabel')
            ->with($requestLabelDTO)
            ->willReturn($response);

        $service = new ShipmentService($repository);
        $result = $service->requestLabel($requestLabelDTO);

        $this->assertInstanceOf(LabelResponseDTO::class, $result);
        $this->assertCount(2, $result->getSuccessAddressCards());
        $this->assertEmpty($result->getFailedAddressCards());
    }

    public function testRequestLabelFailure() {
        $requestLabelDTO = new RequestLabelDTO(
            'customerCode123',
            ['barcode1', 'barcode2'],
            'RESPONSE'
        );
        $repository = $this->createMock(ShipmentRepositoryInterface::class);

        $response = [
            'failedAddressCards' => [
                ['barcode' => 'barcode1', 'messageCode' => 'ERR01']
            ],
            'successAddressCards' => [
                ['barcode' => 'barcode2', 'filedata' => 'base64data2']
            ]
        ];

        $repository->expects($this->once())
            ->method('requestLabel')
            ->with($requestLabelDTO)
            ->willReturn($response);

        $service = new ShipmentService($repository);
        $result = $service->requestLabel($requestLabelDTO);

        $this->assertInstanceOf(LabelResponseDTO::class, $result);
        $this->assertCount(1, $result->getSuccessAddressCards());
        $this->assertCount(1, $result->getFailedAddressCards());
    }
}
