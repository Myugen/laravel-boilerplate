<?php

namespace App;

use App\Enums\DeliveryChannel;
use App\Enums\NotificationState;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use CastsEnums;

    protected $enumCasts = [
        "state" => NotificationState::class,
        "channel" => DeliveryChannel::class
    ];

    public function messages()
    {
        return $this->belongsTo("App\Message");
    }

    public function receiver()
    {
        return $this->belongsTo("App\Receiver");
    }
}
