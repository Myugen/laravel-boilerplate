<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

class MessageState extends Enum
{
    const DRAFT = "DRAFT";
    const PENDING = "PENDING";
    const SENDING = "SENDING";
    const SENT = "SENT";
}
