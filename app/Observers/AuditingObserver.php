<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class AuditingObserver
{
    private $userLogin;

    public function __construct()
    {
        $user = Auth::user();
        $this->userLogin = isset($user) ? $user->getAuthIdentifierName() : "system";
    }

    public function saving($model)
    {
        $model->updated_by = $this->userLogin;
    }


    public function creating($model)
    {
        $model->created_by = $this->userLogin;
    }
}
