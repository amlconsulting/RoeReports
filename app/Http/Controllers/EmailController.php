<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function send(Request $request){
        $data = array(
            'title' => Input::get('title'),
            'content' => Input::get('content')
        );

        $to = Input::get('email');

        Mail::send('emails.send', $data, function($message) use ($to){
            $message->to($to);
        });

        return response()->json(['message' => 'Request completed']);
    }
}
