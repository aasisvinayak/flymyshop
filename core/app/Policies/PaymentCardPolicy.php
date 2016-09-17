<?php

namespace App\Policies;

use App\Http\Models\PaymentCard;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentCardPolicy
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

    public function show(User $user, PaymentCard $paymentCard)
    {
        $user->id === $paymentCard->user_id;
    }

    public function delete(User $user, PaymentCard $paymentCard)
    {
        $user->id === $paymentCard->user_id;
    }
}
