<?php

namespace App\Http\Controllers;

use Mail;
use App\User;

class EmailController extends Controller {

    /**
     * Send an email to the user
     *
     * @param $layout
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send($layout, User $user){
        try {
            Mail::send(['emails.html.' . $layout, 'emails.text.' . $layout], ['user' => $user], function($message) use ($layout, $user){
                $message->to($user['notification_email'])->subject(self::getSubject($layout));
            });
        } catch(Exception $ex) {
            return response()->json(['message' => $ex->getMessage()]);
        }

        return response()->json(['message' => 'Request completed']);
    }

    /**
     * Returns the email subject based on the type of notification
     *
     * @param $layout
     * @return string
     */
    protected static function getSubject($layout){
        switch($layout){
            case 'welcome':
                return 'Welcome to ' . env('APP_NAME') . '!';
                break;
            case 'confirm':
                return 'Please confirm your email address';
                break;
            default:
                return 'Notification from ' . env('APP_NAME');
                break;
        }
    }
}