<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller {

    protected $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function getUserSubscription() {
        return $this->user;
    }
}
