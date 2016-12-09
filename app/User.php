<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'notification_email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be mutated to dates
     *
     * @var array
     */
    protected $dates = [
        'trial_ends_at', 'subscription_ends_at'
    ];

    /**
     * Boot the model.
     *
     */
    public static function boot() {
        parent::boot();

        static::creating(function($user) {
            $user->activation_token = str_random(40);
        });
    }

    /**
     * Activates the user's account
     *
     * @return void
     */
    public function activateUser() {
        $this->verified = true;
        $this->activation_token = null;
        $this->trial_ends_at = Carbon::now()->addDays(14);
        $this->save();
    }
}
