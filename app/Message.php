<?php

namespace App;

use App\Enums\NotificationState;
use BenSampo\Enum\Traits\CastsEnums;

class Message extends Auditing
{
    use CastsEnums;

    protected $fillable = ["title", "body"];
    protected $enumCasts = [
        "state" => NotificationState::class
    ];
    protected $dates = [
        "sent_at"
    ];
}
