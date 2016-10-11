<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;

class EmailController extends Controller
{

    public function send(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function($message) {
            $message->to('amlane86@yahoo.com');
        });

        return response()->json(['message' => 'Request completed']);
    }
}
