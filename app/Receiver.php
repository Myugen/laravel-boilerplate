<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    public $timestamps = false;
    protected $fillable = ["name", "surname", "email", "telephone_number", "telegram_account"];
}
