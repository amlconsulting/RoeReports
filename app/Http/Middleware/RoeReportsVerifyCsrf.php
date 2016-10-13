<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 10/8/2016
 * Time: 10:49 AM
 */

namespace App\Http\Middleware;

class RoeReportsVerifyCsrf extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken {
   protected $except = ['/send/welcome'];
}