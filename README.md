# omniva-sdk

Original documentation of Omniva
https://www.omniva.lv/integrations_with_omniva

    use Lieroes\OmnivaSDK\Application\Services\ShipmentService;
    use Lieroes\OmnivaSDK\Domain\Entities\Shipment;
    use Lieroes\OmnivaSDK\Domain\Enums\DeliveryChannel;
    use Lieroes\OmnivaSDK\Domain\Enums\MainService;
    use Lieroes\OmnivaSDK\Domain\ValueObjects\Address;
    use Lieroes\OmnivaSDK\Domain\ValueObjects\CustomerCode;
    use Lieroes\OmnivaSDK\Infrastructure\Http\OmnivaHttpClient;
    use Lieroes\OmnivaSDK\Infrastructure\Logging\LoggerFactory;
    use Lieroes\OmnivaSDK\Infrastructure\Repositories\ShipmentRepository;
    
    $logger = LoggerFactory::createLogger('OmnivaSDK');

    $httpClient = new OmnivaHttpClient('username', 'password', $logger);

    $shipmentRepository = new ShipmentRepository($httpClient);

    $shipmentService = new ShipmentService($shipmentRepository, $logger);

    $shipment = new Shipment(
        new CustomerCode('12345'),
        MainService::PARCEL,
        DeliveryChannel::PARCEL_MACHINE,
        new Address('EE', 'Tartu', '51003', 'Ülikooli 2A'),
        new Address('EE', 'Tartu', '51003', 'Ülikooli 2A')
    );

    $shipmentService->createShipment($shipment);
