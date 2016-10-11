<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 10/8/2016
 * Time: 10:49 AM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;

class RoeReportsVerifyCsrf extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken {
    /**
     * Handle the incoming request
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     *
     * @throws \Illuminate\Session\TokenMismatchException
     */
    public function handle($request, Closure $next){
        if($this->isAuthExcludedRoutes($request)){
            return $this->addCookieToResponse($request, $next($request));
        }

        if($this->isReading($request) || $this->tokensMatch($request)){
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }

    /**
     * This will return a bool value bases on the route checking and APP_API_KEY nad APP_API_SECRET
     *
     * @param Request $request
     * @return boolean
     *
     * @throws unauthenticated
     */
    protected function isAuthExcludedRoutes($request){
        /*
         *
         * STILL NEED TO ADD AUTHENICATION WITH API KEY AND SECRET
         * ALSO NEED TO SET ROUTES TO THE TOKEN EXCLUDE FILE INSTEAD OF HARDCODED HERE
         */

        $routes = ['/send']; //include '../../../routes/tokenexclude.php';

        foreach($routes as $route){
            if($request->is($route)){ //&& base64_decode($request->input('token') === env('APP_API_SECRET'))){
                return true;
            }
        }

        return false;
    }
}