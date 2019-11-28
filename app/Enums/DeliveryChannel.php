<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

class DeliveryChannel extends Enum
{
    const EMAIL = "EMAIL";
    const SMS = "SMS";
    const TELEGRAM = "TELEGRAM";
}
