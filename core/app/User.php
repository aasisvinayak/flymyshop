<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;

    //TODO: use User::has for user_type

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id', 'avatar', 'stripe_id', 'card_brand', 'card_last_four',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Http\Models\Address');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payment_cards()
    {
        return $this->hasMany('App\Http\Models\PaymentCard');
    }

    /**
     * Returns all invoices associated with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany('App\Http\Models\Invoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('App\Http\Models\UserDetail');
    }

    public function scopeGetEmailFromCustomerId($query, $customer_id)
    {
        return $query->select('email')->where('stripe_id', '=', $customer_id)->get();
    }

    public function scopeUserCount($query, $time)
    {
        return $query->select('id')
            ->where('created_at', '>', $time)->count();
    }

}
