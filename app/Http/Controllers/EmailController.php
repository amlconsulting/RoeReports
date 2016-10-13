<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    /**
     * Welcome email after registration
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function welcome(Request $request){
        return $this->send('welcome', $request->input('email'), [
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
    }

    /**
     * Send and email to the user
     *
     * @param $layout
     * @param $to
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function send($layout, $to, $data){
        try {
            Mail::send(['emails.html' . $layout, 'emails.text.' . $layout], $data, function($message) use ($layout, $to){
                $message->to($to)->subject($this->getSubject($layout));
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
    private function getSubject($layout){
        switch($layout){
            case 'welcome':
                return 'Welcome to ' . env('APP_NAME') . '!';
                break;
            default:
                return 'Notification from ' . env('APP_NAME');
                break;
        }
    }
}
