<?php

namespace Lieroes\OmnivaSDK\Domain\Entities;

use Lieroes\OmnivaSDK\Domain\Exception\InvalidShipmentException;
use Lieroes\OmnivaSDK\Domain\ValueObjects\Addresee;
use Lieroes\OmnivaSDK\Domain\ValueObjects\Address;
use Lieroes\OmnivaSDK\Domain\ValueObjects\CustomerCode;
use Lieroes\OmnivaSDK\Domain\Enums\MainService;
use Lieroes\OmnivaSDK\Domain\Enums\DeliveryChannel;

class Shipment
{
    public function __construct(
        private CustomerCode    $customerCode,
        private MainService     $mainService,
        private DeliveryChannel $deliveryChannel,
        private Addresee        $senderAddressee,
        private Addresee        $receiverAddressee,
        private ?string         $partnerShipmentId = null,
        private ?string         $shipmentComment = null,
        private bool            $returnAllowed = false,
        private bool            $paidByReceiver = false,
        private ?string         $servicePackage = null,
        private ?int            $allowedStoringPeriod = null,
        private ?array          $notifications = null,
        private ?array          $addServices = null,
        private ?array          $customs = null
    )
    {
        $this->validateFields(
            $mainService,
            $deliveryChannel,
            $receiverAddressee,
            $senderAddressee,
            $partnerShipmentId,
            $servicePackage,
            $allowedStoringPeriod,
            $notifications,
            $addServices,
            $customs
        );
    }

    private function validateFields(
        MainService     $mainService,
        DeliveryChannel $deliveryChannel,
        Addresee        $receiverAddressee,
        Addresee        $senderAddressee,
        ?string         $partnerShipmentId,
        ?string         $servicePackage,
        ?int            $allowedStoringPeriod,
        ?array          $notifications,
        ?array          $addServices,
        ?array          $customs
    ): void
    {
        if ($mainService === MainService::PARCEL && $deliveryChannel === DeliveryChannel::PARCEL_MACHINE && !$receiverAddressee->getAddress()->getOffloadPostcode()) {
            throw InvalidShipmentException::missingField("offloadPostcode");
        }

        if ($mainService === MainService::LETTER && !$partnerShipmentId) {
            throw InvalidShipmentException::missingField("partnerShipmentId");
        }

        if (!$receiverAddressee->getAddress()->getCountry()) {
            throw InvalidShipmentException::missingField("receiverAddress.country");
        }

        if (!$receiverAddressee->getAddress()->getPostcode() && !$receiverAddressee->getAddress()->getOffloadPostcode()) {
            throw InvalidShipmentException::missingField("receiverAddressee.postcode or receiverAddressee.offloadPostcode");
        }

        if (!$senderAddressee->getAddress()->getCountry()) {
            throw InvalidShipmentException::missingField("senderAddress.country");
        }

        if (!$this->senderAddressee->getAddress()->getPostcode()) {
            throw InvalidShipmentException::missingField("senderAddress.postcode");
        }

        if (strlen($partnerShipmentId) > 30) {
            throw InvalidShipmentException::invalidValue("partnerShipmentId", "must be less than or equal to 30 characters");
        }

        // Validate service package
        if ($mainService === MainService::LETTER && !$servicePackage) {
            throw InvalidShipmentException::missingField("servicePackage");
        }

        // Validate storing period for procedural document
        if ($servicePackage === 'PROCEDURAL_DOCUMENT' && ($allowedStoringPeriod !== 0 && $allowedStoringPeriod !== 15 && $allowedStoringPeriod !== 30)) {
            throw InvalidShipmentException::invalidValue("allowedStoringPeriod", "must be 0, 15, or 30");
        }

        // Validate notifications
        if ($notifications) {
            foreach ($notifications as $notification) {
                if (!isset($notification['type']) || !isset($notification['channel'])) {
                    throw InvalidShipmentException::invalidValue("notifications", "type and channel must be specified");
                }
            }
        }

        // Validate add services
        if ($addServices) {
            foreach ($addServices as $addService) {
                if (!isset($addService['code'])) {
                    throw InvalidShipmentException::invalidValue("addServices", "code must be specified");
                }

                if ($addService['code'] === 'COD' && (!isset($addService['params']['COD_AMOUNT']) || !isset($addService['params']['COD_BANK_ACCOUNT_NO']))) {
                    throw InvalidShipmentException::invalidValue("addServices", "COD_AMOUNT and COD_BANK_ACCOUNT_NO must be specified for COD service");
                }
            }
        }

        // Validate customs
        if ($customs) {
            if (!isset($customs['goodsCategoryCode'])) {
                throw InvalidShipmentException::missingField("customs.goodsCategoryCode");
            }

            if ($customs['goodsCategoryCode'] === 'OTHER' && !isset($customs['categoryExplanation'])) {
                throw InvalidShipmentException::missingField("customs.categoryExplanation");
            }

            if (isset($customs['shipmentItems'])) {
                foreach ($customs['shipmentItems'] as $item) {
                    if (!isset($item['description']) || !isset($item['numberOfPieces']) || !isset($item['weight']) || !isset($item['financialValue']) || !isset($item['tariffNumber'])) {
                        throw InvalidShipmentException::missingField("customs.shipmentItems.[description, numberOfPieces, weight, financialValue, tariffNumber]");
                    }
                }
            }
        }
    }

    public function getCustomerCode(): CustomerCode
    {
        return $this->customerCode;
    }

    public function getMainService(): MainService
    {
        return $this->mainService;
    }

    public function getDeliveryChannel(): DeliveryChannel
    {
        return $this->deliveryChannel;
    }

    public function getReceiverAddress(): Address
    {
        return $this->receiverAddress;
    }

    public function getSenderAddress(): Address
    {
        return $this->senderAddress;
    }

    public function getPartnerShipmentId(): ?string
    {
        return $this->partnerShipmentId;
    }

    public function getShipmentComment(): ?string
    {
        return $this->shipmentComment;
    }

    public function isReturnAllowed(): bool
    {
        return $this->returnAllowed;
    }

    public function isPaidByReceiver(): bool
    {
        return $this->paidByReceiver;
    }

    public function getServicePackage(): ?string
    {
        return $this->servicePackage;
    }

    public function getAllowedStoringPeriod(): ?int
    {
        return $this->allowedStoringPeriod;
    }

    public function getNotifications(): ?array
    {
        return $this->notifications;
    }

    public function getAddServices(): ?array
    {
        return $this->addServices;
    }

    public function getCustoms(): ?array
    {
        return $this->customs;
    }

    public function toArray(): array
    {
        $data = array_filter([
            'mainService' => $this->mainService->value,
            'deliveryChannel' => $this->deliveryChannel->value,
            'partnerShipmentId' => $this->partnerShipmentId,
            'shipmentComment' => $this->shipmentComment,
            'returnAllowed' => $this->returnAllowed,
            'paidByReceiver' => $this->paidByReceiver,
            'servicePackage' => $this->servicePackage,
            'allowedStoringPeriod' => $this->allowedStoringPeriod,
            'senderAddressee' => $this->senderAddressee->toArray(),
            'receiverAddressee' => $this->receiverAddressee->toArray(),
            'notifications' => $this->notifications,
            'addServices' => $this->addServices,
            'customs' => $this->customs,
        ]);

        return array_filter([
            'customerCode' => $this->customerCode->getCode(),
            'shipments' => [
                $data
            ]
        ]);
    }
}
