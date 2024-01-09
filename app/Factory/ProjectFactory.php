<?php

namespace App\Factory;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Type;
use Illuminate\Support\Str;

class ProjectFactory
{

    private $typeId;
    private $title;
    private $createdAtTime;
    private $deadline;
    private $contractedAt;
    private $isChain;
    private $isOnTime;
    private $hasOutsource;
    private $hasInvenstors;
    private $workerCount;
    private $serviceCount;
    private $paymentFirstStep;
    private $paymentSecondStep;
    private $paymentThirdStep;
    private $paymentFourthStep;
    private $comment;
    private $effectiveValue;

    public function __construct($typeId, $title, $createdAtTime, $deadline, $contractedAt, $isChain, $isOnTime, $hasOutsource, $hasInvenstors, $workerCount, $serviceCount, $paymentFirstStep, $paymentSecondStep, $paymentThirdStep, $paymentFourthStep, $comment, $effectiveValue)
    {
        $this->typeId = $typeId;
        $this->title = $title;
        $this->createdAtTime = $createdAtTime;
        $this->deadline = $deadline;
        $this->contractedAt = $contractedAt;
        $this->isChain = $isChain;
        $this->isOnTime = $isOnTime;
        $this->hasOutsource = $hasOutsource;
        $this->hasInvenstors = $hasInvenstors;
        $this->workerCount = $workerCount;
        $this->serviceCount = $serviceCount;
        $this->paymentFirstStep = $paymentFirstStep;
        $this->paymentSecondStep = $paymentSecondStep;
        $this->paymentThirdStep = $paymentThirdStep;
        $this->paymentFourthStep = $paymentFourthStep;
        $this->comment = $comment;
        $this->effectiveValue = $effectiveValue;
    }

    public static function make($map, $row)
    {
        return new self(
            self::getTypeId($map, $row['tip']),
            $row['naimenovanie'],
            Date::excelToDateTimeObject($row['data_sozdaniia']),
            isset($row['dedlain']) ? Date::excelToDateTimeObject($row['dedlain']) : null,
            Date::excelToDateTimeObject($row['podpisanie_dogovora']),
            isset($row['setevik']) ? self::getBool($row['setevik']) : null,
            isset($row['sdaca_v_srok']) ? self::getBool($row['sdaca_v_srok']) : null,
            isset($row['nalicie_autsorsinga']) ? self::getBool($row['nalicie_autsorsinga']) : null,
            isset($row['nalicie_investorov']) ? self::getBool($row['nalicie_investorov']) : null,
            $row['kolicestvo_ucastnikov'] ?? null,
            $row['kolicestvo_uslug'] ?? null,
            $row['vlozenie_v_pervyi_etap'] ?? null,
            $row['vlozenie_vo_vtoroi_etap'] ?? null,
            $row['vlozenie_v_tretii_etap'] ?? null,
            $row['vlozenie_v_cetvertyi_etap'] ?? null,
            $row['kommentarii'] ?? null,
            $row['znacenie_effektivnosti'] ?? null,
        );
    }



    private static function getTypeId($map, $title){
        return isset($map[$title]) ? $map[$title] : Type::create(['title' => $title])->id;
    }


    private static function getBool($item):bool
    {
        return $item == 'Да';
    }

    public function getValues(): array
    {
        $props = get_object_vars($this);

        $res = [];
        foreach($props as $key => $prop) {
            $res[Str::snake($key)] = $prop;
        }

        return $res;
    }

}