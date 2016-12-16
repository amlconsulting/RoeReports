<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LegalController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return mixed
     */
    public function __construct() {
        $this->middleware('guest');
    }

}
