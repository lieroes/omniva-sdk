<?php

namespace Lieroes\OmnivaSDK\Tests\Application\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Lieroes\OmnivaSDK\Application\DTOs\DeliveryPoints\DeliveryPointDTO;
use Lieroes\OmnivaSDK\Application\Services\DeliveryPointService;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;


class DeliveryPointServiceTest extends TestCase {
    public function testGetDeliveryPointsSuccess() {
        $mockResponseData = [
            [
                "ZIP" => "96331",
                "NAME" => "1. eelistus/Picapac pakiautomaat",
                "TYPE" => "0",
                "A0_NAME" => "EE",
                "A1_NAME" => "1. eelistus Omnivas",
                "A2_NAME" => "1. eelistus Omnivas",
                "A3_NAME" => "",
                "A4_NAME" => "",
                "A5_NAME" => "",
                "A6_NAME" => "",
                "A7_NAME" => "",
                "A8_NAME" => "",
                "X_COORDINATE" => "24.793373",
                "Y_COORDINATE" => "59.430318",
                "SERVICE_HOURS" => "",
                "TEMP_SERVICE_HOURS" => "",
                "TEMP_SERVICE_HOURS_UNTIL" => "",
                "TEMP_SERVICE_HOURS_2" => "",
                "TEMP_SERVICE_HOURS_2_UNTIL" => "",
                "comment_est" => "",
                "comment_eng" => "",
                "comment_rus" => "",
                "comment_lav" => "",
                "comment_lit" => "",
                "MODIFIED" => "2023-09-12T10:18:52.167+03:00"
            ]
        ];

        $mockResponse = new Response(200, [], json_encode($mockResponseData));
        $mockClient = $this->createMock(Client::class);
        $mockClient->expects($this->once())
            ->method('get')
            ->with('https://www.omniva.ee/locationsfull.json')
            ->willReturn($mockResponse);

        $mockLogger = $this->createMock(Logger::class);
        $mockLogger->expects($this->once())
            ->method('info')
            ->with('Fetched delivery points successfully', ['count' => count($mockResponseData)]);

        $service = new DeliveryPointService($mockClient, $mockLogger);
        $result = $service->getDeliveryPoints();

        $this->assertContainsOnlyInstancesOf(DeliveryPointDTO::class, $result);
    }

    public function testGetDeliveryPointsError() {
        $mockClient = $this->createMock(Client::class);
        $mockClient->expects($this->once())
            ->method('get')
            ->with('https://www.omniva.ee/locationsfull.json')
            ->willThrowException(new RequestException("Error", $this->createMock(RequestInterface::class)));

        $mockLogger = $this->createMock(Logger::class);
        $mockLogger->expects($this->once())
            ->method('error')
            ->with('Error fetching delivery points', ['error' => 'Error']);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Error fetching delivery points: Error');

        $service = new DeliveryPointService($mockClient, $mockLogger);
        $service->getDeliveryPoints();
    }
}
