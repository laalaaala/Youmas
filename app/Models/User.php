<?php

namespace App\Models;

use App\Mail\ForgotPasswordMailable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = true;

    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'verification_token',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function stripeAccount()
    {
        return $this->hasOne(UserStripeAccount::class);
    }

    public function business()
    {
        return $this->hasOne(Business::class, 'user_id')->with('branch');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function location()
    {
        return $this->hasOne(UserLocation::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'customer_id');
    }

    public function customerTransactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    public function businessTransactions()
    {
        return $this->hasMany(Transaction::class, 'business_id');
    }

    public function reviews()
    {
        return $this->hasMany(BusinessReview::class)->with('customer')->with('service');
    }

    public function subscription()
    {
        return $this->hasOne(StripeSubscription::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Business::class, 'user_x_favorites', 'user_id', 'business_id');
    }


    public function sendPasswordResetNotification($token)
    {
        if ($this->type == 'business') {
            $data = [
                'email' => $this->email,
                'name' => $this->business->name,
                'token' => $token,
            ];
        } else {
            $data = [
                'email' => $this->email,
                'name' => $this->business->name,
                'token' => $token,
            ];
        }
        Mail::send(new ForgotPasswordMailable($data));
    }
}
