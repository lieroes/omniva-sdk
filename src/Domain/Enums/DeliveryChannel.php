<?php

namespace Lieroes\OmnivaSDK\Domain\Enums;

enum DeliveryChannel: string {
    case COURIER = 'COURIER';
    case POST_OFFICE = 'POST_OFFICE';
    case PARCEL_MACHINE = 'PARCEL_MACHINE';
}
