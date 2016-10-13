<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;

class EmailController extends Controller
{

    public function send(Request $request){
        $data = array(
            'title' => $request->input('title'),
            'content' => $request->input('content')
        );

        $to = $request->input('email');

        Mail::send('emails.send', $data, function($message) use ($to){
            $message->to($to);
        });

        return response()->json(['message' => 'Request completed']);
    }
}
