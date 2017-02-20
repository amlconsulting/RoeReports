<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Laravel\Cashier;
use Stripe;
use Validator;

class SubscriptionController extends Controller {

    protected $user;

    public function __construct() {
        Stripe\Stripe::setApiKey(Cashier\Billable::getStripeKey());
    }

    /**
     * Shows the user the plan choices
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function plans(Request $request) {
        $this->middleware('auth');
        $subscription = $request->user()->subscription('main');

        return view('subscriptions.plans', [
            'plans' => $this->getPlans(),
            'user_current_plan' =>$subscription['attributes']['stripe_plan']
        ]);
    }

    /**
     * Shows the guest user the plan choices
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPlans() {
        $this->middleware('guest');
        return view('subscriptions.plans', [
            'plans' => $this->getPlans()
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
        $this->middleware('auth');
        $token = $request->input('stripeToken');

        $plan_details = Stripe\Plan::retrieve($plan)->__toArray();

        $request->user()->newSubscription('main', $plan)->trialDays($plan_details['trial_period_days'])->create($token, [
            'email' => $request->user()->notification_email
        ]);

        if($request->user()->subscribed('main', $plan)) {
            flash('Your subscription is active. Thank you!', 'success');
        } else {
            flash('There was a problem activating your subscription.', 'warning');
        }

        return redirect('user/profile');
    }

    /**
     * Swap plans for the user
     *
     * @param Request $request
     * @param String $plan
     * @return \Illuminate\Http\Response
     */
    public function swap(Request $request, $plan) {
        $this->middleware('auth');

        $request->user()->subscription('main')->swap($plan);

        if($request->user()->subscribed('main', $plan)) {
            flash('Your subscription has been switched.', 'success');
        } else {
            flash('There was a problem switching your subscription.', 'warning');
        }

        return redirect('user/profile');
    }

    /**
     * Confirmation page to cancel subscription
     *
     * @param Request $request
     * @param String $plan
     * @return \Illuminate\Http\Response
     */
    public function cancelConfirm(Request $request, $plan) {
        $this->middleware('auth');

        return view('subscriptions.cancel', [
            'plan' => $plan
        ]);
    }

    /**
     * Cancel the user's subscription
     *
     * @param Request $request
     * @param String $plan
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, $plan) {
        $this->middleware('auth');

        $messages = [
            'g-recaptcha-response.required' => "You must prove you're human first."
        ];

        $validations = ['g-recaptcha-response' => 'required:captcha'];

        Validator::make($request->all(), $validations, $messages)->validate();

        $request->user()->subscription('main')->cancel();

        if($request->user()->subscribed('main', $plan)) {
            flash('Hope to see you again. Your subscription has been canceled.', 'success');
        } else {
            flash('There was a problem canceling your subscription.', 'warning');
        }

        return redirect('user/profile');
    }

    /**
     * Resume the user's subscription
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function resume(Request $request) {
        $this->middleware('auth');

        $request->user()->subscription('main')->resume();

        if(!$request->user()->subscription('main')->onGracePeriod()) {
            flash('Your subscription has been resumed. Glad you decided to stay!', 'success');
        } else {
            flash('There was a problem resuming your subscription.', 'warning');
        }

        return redirect('user/profile');
    }

    /**
     * Update the user's card
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateCard(Request $request) {
        $this->middleware('auth');

        try {
            $request->user()->updateCard($request->input('stripeToken'));
        } catch(Exceptions $e) {
            flash('There was a problem updating your card information.', 'warning');
        }

        flash('Your card has been updated.', 'success');

        return redirect('user/profile');
    }

    /**
     * Get the sorted plans
     *
     * @return Array $plans
     */
    private function getPlans() {
        $plans = Stripe\Plan::all()->__toArray();
        $sorted_plans = Array();

        foreach($plans['data'] as $plan) {
            $sorted_plans[$plan['metadata']['sequence']] = $plan;
        }

        ksort($sorted_plans);

        return $sorted_plans;
    }
}
