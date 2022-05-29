<?php

namespace App\Policies\Business;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessSubscriptionsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function before(User $user)
    {
        if ($user->type == 'admin') {
            return true;
        }
    }

    /**
     * Determine if the given user can create a customer in his name.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function createCustomer(User $user, $local_user)
    {
        return $user->id === $local_user->id;
    }

    /**
     * Determine if the given user is the owner and can update the subscription.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */

    public function update(User $user, $subscription)
    {
        return $user->id === $subscription->user_id;
    }
}
