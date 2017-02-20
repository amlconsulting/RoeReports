<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoices;
use App\Clients;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return mixed
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the user's dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request) {
        if(!$request->user()->subscribed('main')) {
            return redirect('subscription/plans');
        }

        $invoices = $request->user()->LLRinvoices()->get();

        return view('dashboard.dashboard', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Show the user's invoices.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function invoices(Request $request) {
        if(!$request->user()->subscribed('main')) {
            return redirect('subscription/plans');
        }

        $invoices = $request->user()->LLRinvoices()->get();

        return view('dashboard.invoices', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Show the user's sales.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request) {
        if(!$request->user()->subscribed('main')) {
            return redirect('subscription/plans');
        }

        return view('dashboard.sales');
    }

}
