<?php

namespace App;

use App\Observers\AuditingObserver;
use Illuminate\Database\Eloquent\Model;

abstract class Auditing extends Model
{
    public static function boot()
    {
        parent::boot();

        $class = get_called_class();
        $class::observe(new AuditingObserver());
    }
}
