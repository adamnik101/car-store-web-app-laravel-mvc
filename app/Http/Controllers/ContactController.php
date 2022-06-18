<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    //
    public function index(){
        return view('user.contact', $this->data);
    }
    public function send(ContactRequest $request)
    {
        $email = $request->email;
        $text = $request->text;
        $subject = $request->subject;
        $to = "adam.nikolic.101.19@ict.edu.rs";
        $body = "<h2>Contact Request</h2>
                 <h4>Email</h4><p>{$email}</p>
                 <h4>Message</h4><p>{$text}</p>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . "<" . $email . ">";
        function sendMailFromLocalhost(){
            return true;
            }
        if (sendMailFromLocalhost()) {
            return redirect()->route("contact")->with(["msg"=>"Uspesno ste poslali poruku administratoru."]);
        }
        else
        {
            return back()->with(["msg"=>"Neuspesno slanje poruke."]);
        }
    }

}
