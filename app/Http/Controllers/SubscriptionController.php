<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Stripe;

class SubscriptionController extends Controller {

    protected $user;

    public function __construct() {
        $this->middleware('auth');
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function getUserSubscription() {
        return $this->user;
    }

    /**
     * Shows the user the plan choices
     *
     * @return \Illuminate\Http\Response
     */
    public function plans() {
        return view('subscriptions.plans', [
            'plans' => Stripe\Plan::all()->__toArray()
        ]);
    }

    /**
     * Open the subscribe form to the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request) {

    }
}
