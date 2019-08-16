<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Validator;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }
    
    /**
     * Send contact mail
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|regex:/^.+@.+$/i',
            'text' => 'required|min:5',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'text' => $validator->errors()->all()
            ]);
        }

        // Load necessary data to build email
        $data = array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'text' => $request->get('text'),
        );
        
        // Send mail
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            //$message->to('info@huh.school', 'HUH? School')
            $message->to('nikolay.a@cudev.org', 'HUH? School')
                //->bcc('ferenax@gmail.com')
                ->subject('Contact');
            $message->from('info@huh.school', $data['name']);
        });
        
        return response()->json([
            'success' => true,
            'type'=>'message',
            'text' => 'Hi '. $data['name'] .'! Thank you for your email',
        ]);
    }
}