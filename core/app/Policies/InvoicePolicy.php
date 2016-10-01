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

    /**
     * User can view only his own invoice
     *
     * @param User    $user
     * @param Invoice $invoice
     * 
     * @return bool
     */
    public function show(User $user, Invoice $invoice)
    {
        return $user->id === (int)$invoice->user_id;
    }

    /**
     * Only an admin can update the invoice (for updating invoice status)
     *
     * @return bool
     */
    public function update()
    {
        $id = Auth::user()->id;
        $type = UserType::getType($id);

        return $type == 'admin' ? true : false;
    }
}
