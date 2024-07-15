<?php

namespace Lieroes\OmnivaSDK\Application\Mappers;

use Lieroes\OmnivaSDK\Application\DTOs\DeliveryPoints\DeliveryPointDTO;
use Lieroes\OmnivaSDK\Domain\Enums\DeliveryPointType;

class DeliveryPointMapper
{
    public static function toDTO(array $data): DeliveryPointDTO {
        return new DeliveryPointDTO([
            'ZIP' => $data['ZIP'],
            'NAME' => $data['NAME'],
            'TYPE' => DeliveryPointType::from($data['TYPE'])->value,
            'A0_NAME' => $data['A0_NAME'],
            'A1_NAME' => $data['A1_NAME'],
            'A2_NAME' => $data['A2_NAME'],
            'A3_NAME' => $data['A3_NAME'],
            'A4_NAME' => $data['A4_NAME'],
            'A5_NAME' => $data['A5_NAME'],
            'A6_NAME' => $data['A6_NAME'],
            'A7_NAME' => $data['A7_NAME'],
            'A8_NAME' => $data['A8_NAME'],
            'X_COORDINATE' => (float)$data['X_COORDINATE'],
            'Y_COORDINATE' => (float)$data['Y_COORDINATE'],
            'SERVICE_HOURS' => $data['SERVICE_HOURS'],
            'TEMP_SERVICE_HOURS' => $data['TEMP_SERVICE_HOURS'],
            'TEMP_SERVICE_HOURS_UNTIL' => $data['TEMP_SERVICE_HOURS_UNTIL'],
            'TEMP_SERVICE_HOURS_2' => $data['TEMP_SERVICE_HOURS_2'],
            'TEMP_SERVICE_HOURS_2_UNTIL' => $data['TEMP_SERVICE_HOURS_2_UNTIL'],
            'comment_est' => $data['comment_est'],
            'comment_eng' => $data['comment_eng'],
            'comment_rus' => $data['comment_rus'],
            'comment_lav' => $data['comment_lav'],
            'comment_lit' => $data['comment_lit'],
            'MODIFIED' => $data['MODIFIED'],
        ]);
    }
}
