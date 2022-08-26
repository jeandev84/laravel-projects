<?php
namespace App\Http\Controllers;

use App\Mail\TestGmailMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



/**
 *
*/
class MailController extends Controller
{

        public function sendEmail()
        {
            $details = [
               'title' => 'Mail from Jean-Claude development',
               'body'  => 'This is for testing mail using gmail'
            ];

            Mail::to("jy2045744@gmail.com")->send(new TestGmailMail($details));

            return "Email sent";
        }
}
