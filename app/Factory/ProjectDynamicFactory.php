<?php

namespace App\Factory;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Type;
use Illuminate\Support\Str;

class ProjectDynamicFactory
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
    private $comment;
    private $effectiveValue;

    public function __construct($typeId, $title, $createdAtTime, $deadline, $contractedAt, $isChain, $isOnTime, $hasOutsource, $hasInvenstors, $workerCount, $serviceCount, $comment, $effectiveValue)
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
        $this->comment = $comment;
        $this->effectiveValue = $effectiveValue;
    }

    public static function make($map, $row)
    {
        return new self(
            self::getTypeId($map, $row['0']),
            $row['1'],
            Date::excelToDateTimeObject($row['2']),
            isset($row['7']) ? Date::excelToDateTimeObject($row['7']) : null,
            Date::excelToDateTimeObject($row['9']),
            isset($row['3']) ? self::getBool($row['3']) : null,
            isset($row['8']) ? self::getBool($row['8']) : null,
            isset($row['5']) ? self::getBool($row['5']) : null,
            isset($row['6']) ? self::getBool($row['6']) : null,
            $row['4'] ?? null,
            $row['10'] ?? null,
            $row['11'] ?? null,
            $row['12'] ?? null,
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