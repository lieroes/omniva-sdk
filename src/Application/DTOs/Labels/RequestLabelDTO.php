<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\Labels;

class RequestLabelDTO
{
    private string $customerCode;
    private array $barcodes;
    private string $sendAddressCardTo;
    private ?string $cardReceiverEmail;

    public function __construct(
        string  $customerCode,
        array   $barcodes,
        string  $sendAddressCardTo,
        ?string $cardReceiverEmail = null
    )
    {
        $this->customerCode = $customerCode;
        $this->barcodes = $barcodes;
        $this->sendAddressCardTo = $sendAddressCardTo;
        $this->cardReceiverEmail = $cardReceiverEmail;
    }

    public function toArray(): array
    {
        $data = [
            'customerCode' => $this->customerCode,
            'barcodes' => $this->barcodes,
            'sendAddressCardTo' => $this->sendAddressCardTo,
        ];

        if ($this->sendAddressCardTo === 'EMAIL' && $this->cardReceiverEmail !== null) {
            $data['cardReceiverEmail'] = $this->cardReceiverEmail;
        }

        return $data;
    }
}
