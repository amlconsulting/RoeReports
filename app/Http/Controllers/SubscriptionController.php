<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Laravel\Cashier;
use Stripe;

class SubscriptionController extends Controller {

    protected $user;

    public function __construct() {
        $this->middleware('auth');
        Stripe\Stripe::setApiKey(Cashier\Billable::getStripeKey());
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
        $this->middleware('guest');
        $plans = Stripe\Plan::all()->__toArray();

        $sorted_plans = Array();

        foreach($plans['data'] as $plan) {
            $sorted_plans[$plan['metadata']['sequence']] = $plan;
        }

        ksort($sorted_plans);

        return view('subscriptions.plans', [
            'plans' => $sorted_plans
        ]);
    }

    /**
     * Open the subscribe form to the user
     *
     * @param Request $request
     * @param String $plan
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request, $plan) {
        $token = Input::get('stripeToken');

        return view('subscriptions.subscribe', [
            'plan' => $plan,
            'token' => $token
        ]);
    }
}
