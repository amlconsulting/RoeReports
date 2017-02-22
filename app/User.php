<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Carbon\Carbon;
use Psy\Util\Json;

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
        'name', 'email', 'notification_email', 'facebook_id', 'facebook_access_token'
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
    }

    /**
     * Activates the user's account
     *
     * @return void
     */
    public function activateUser() {
        $this->verified = true;
        $this->activation_token = null;
        $this->save();
    }

    /**
     * Get the client's LuLaRoe credentials
     *
     * @return JSON
     */
    public function lularoeCredentials() {
        return $this->hasOne('App\LuLaRoeCredentials');
    }

    /**
     * Get the client's LuLaRoe cookies
     *
     * @return JSON
     */
    public function lularoeCookies() {
        return $this->hasOne('App\LuLaRoeCookies');
    }

    /**
     * Get the client's invoices
     *
     * @return JSON
     */
    public function LLRinvoices() {
        return $this->hasMany('App\Invoices');
    }

    /**
     * Get the user's clients
     *
     * @return Json
     */
    public function clients() {
        return $this->hasMany('App\Clients');
    }

}
