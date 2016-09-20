<?php

namespace App\Policies;

use App\Http\Models\Invoice;
use App\Http\Models\UserType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class InvoicePolicy
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

    public function show(User $user, Invoice $invoice)
    {
            return $user->id === $invoice->user_id;
    }

    public function update()
    {
        $id = Auth::user()->id;
        $type = UserType::getType($id);
        return $type=="admin" ? true:false;
    }
}
