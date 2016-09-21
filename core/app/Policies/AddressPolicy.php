<?php

namespace App\Policies;

use App\Http\Models\Address;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
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

    public function show(User $user, Address $address)
    {
        return $user->id === (int) $address->user_id;
    }

    public function update(User $user, Address $address)
    {
        return $user->id === (int) $address->user_id;
    }

    public function delete(User $user, Address $address)
    {
        return $user->id === (int) $address->user_id;
    }
}
