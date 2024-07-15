<?php

namespace Lieroes\OmnivaSDK\Application\DTOs\DeliveryPoints;

class DeliveryPointDTO {
    private string $zip;
    private string $name;
    private string $type;
    private string $country;
    private string $a1Name;
    private string $a2Name;
    private string $a3Name;
    private string $a4Name;
    private string $a5Name;
    private string $a6Name;
    private string $a7Name;
    private string $a8Name;
    private float $xCoordinate;
    private float $yCoordinate;
    private string $serviceHours;
    private string $tempServiceHours;
    private string $tempServiceHoursUntil;
    private string $tempServiceHours2;
    private string $tempServiceHours2Until;
    private string $commentEst;
    private string $commentEng;
    private string $commentRus;
    private string $commentLav;
    private string $commentLit;
    private string $modified;

    public function __construct(array $data) {
        $this->zip = $data['ZIP'];
        $this->name = $data['NAME'];
        $this->type = $data['TYPE'];
        $this->country = $data['A0_NAME'];
        $this->a1Name = $data['A1_NAME'];
        $this->a2Name = $data['A2_NAME'];
        $this->a3Name = $data['A3_NAME'];
        $this->a4Name = $data['A4_NAME'];
        $this->a5Name = $data['A5_NAME'];
        $this->a6Name = $data['A6_NAME'];
        $this->a7Name = $data['A7_NAME'];
        $this->a8Name = $data['A8_NAME'];
        $this->xCoordinate = (float)$data['X_COORDINATE'];
        $this->yCoordinate = (float)$data['Y_COORDINATE'];
        $this->serviceHours = $data['SERVICE_HOURS'];
        $this->tempServiceHours = $data['TEMP_SERVICE_HOURS'];
        $this->tempServiceHoursUntil = $data['TEMP_SERVICE_HOURS_UNTIL'];
        $this->tempServiceHours2 = $data['TEMP_SERVICE_HOURS_2'];
        $this->tempServiceHours2Until = $data['TEMP_SERVICE_HOURS_2_UNTIL'];
        $this->commentEst = $data['comment_est'];
        $this->commentEng = $data['comment_eng'];
        $this->commentRus = $data['comment_rus'];
        $this->commentLav = $data['comment_lav'];
        $this->commentLit = $data['comment_lit'];
        $this->modified = $data['MODIFIED'];
    }

    public function getZip(): string { return $this->zip; }
    public function getName(): string { return $this->name; }
    public function getType(): string { return $this->type; }
    public function getCountry(): string { return $this->country; }
    public function getA1Name(): string { return $this->a1Name; }
    public function getA2Name(): string { return $this->a2Name; }
    public function getA3Name(): string { return $this->a3Name; }
    public function getA4Name(): string { return $this->a4Name; }
    public function getA5Name(): string { return $this->a5Name; }
    public function getA6Name(): string { return $this->a6Name; }
    public function getA7Name(): string { return $this->a7Name; }
    public function getA8Name(): string { return $this->a8Name; }
    public function getXCoordinate(): float { return $this->xCoordinate; }
    public function getYCoordinate(): float { return $this->yCoordinate; }
    public function getServiceHours(): string { return $this->serviceHours; }
    public function getTempServiceHours(): string { return $this->tempServiceHours; }
    public function getTempServiceHoursUntil(): string { return $this->tempServiceHoursUntil; }
    public function getTempServiceHours2(): string { return $this->tempServiceHours2; }
    public function getTempServiceHours2Until(): string { return $this->tempServiceHours2Until; }
    public function getCommentEst(): string { return $this->commentEst; }
    public function getCommentEng(): string { return $this->commentEng; }
    public function getCommentRus(): string { return $this->commentRus; }
    public function getCommentLav(): string { return $this->commentLav; }
    public function getCommentLit(): string { return $this->commentLit; }
    public function getModified(): string { return $this->modified; }
}
