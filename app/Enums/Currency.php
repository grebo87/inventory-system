<?php

namespace App\Enums;

enum Currency: string
{
    case USD = 'Dolar';
    case Box = 'box';
    case Gallons = 'gallons';
    case Grams = 'grams';
    case Kilograms = 'kilograms';
    case Liters = 'liters';
    case Meters = 'meters';
    case Feet = 'feet';
    case Inches = 'inches';
    case Units = 'units';
    case Yards = 'yards';
    case Hour = 'hour';

    function getLabel(): string
    {
        return __('units.' . $this->value);
    }

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->getLabel();
        }
        return $array;
    }
}
