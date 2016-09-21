<?php

namespace App\Policies;

use App\Http\Models\UserDetail;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserDetailPolicy
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

    public function update(User $user, UserDetail $userDetail)
    {
        return  $user->id === (int) $userDetail->user_id;
    }

    public function show(User $user, UserDetail $userDetail)
    {
        return  $user->id === $userDetail->user_id;
    }

    public function delete(User $user, UserDetail $userDetail)
    {
        return  $user->id === $userDetail->user_id;
    }
}
