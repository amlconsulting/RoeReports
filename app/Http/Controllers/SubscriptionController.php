<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Stripe;

class SubscriptionController extends Controller {

    protected $user;

    public function __construct() {
        $this->middleware('auth');
    }

    public function getUserSubscription() {
        return $this->user;
    }

    /**
     * Shows the user the plan choices
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function plans(Request $request) {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $plans = Stripe\Plan::all();

        return view('subscriptions.plans', [
            'plans' => $plans
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
