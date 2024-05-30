<?php

namespace Lieroes\OmnivaSDK\Domain\Enums;

enum DeliveryPointType: string
{
    case PARCEL_MACHINE = '0';
    case POST_OFFICE = '1';
    case COURIER = '2';
}
