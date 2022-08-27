<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

       public function contactForm()
       {
            return view('form.contact-us');
       }


       public function sendEmail(Request $request)
       {
            $details = [
               'name'   => $request->name,
               'email'   => $request->email,
               'phone'   => $request->phone,
               'message' => $request->message
            ];


            Mail::to('jy2045744@gmail.com')->send(new ContactMail($details));

            return back()->with('message_sent', 'Your message has been sent successfully!');

       }
}
