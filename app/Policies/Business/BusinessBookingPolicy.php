<?php

namespace App\Policies\Business;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessBookingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
