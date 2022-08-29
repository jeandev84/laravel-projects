### Contact Form 


```php 

./.env

MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=jeanyao@gmail.com
MAIL_PASSWORD=secret!
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=jeanyao@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

https://mail.google.com/mail/

Security => Activate "Access Account Securite"  (On / Active)


$ php artisan make:controller Form/ContactController


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



$ php artisan make:mail ContactMail

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * @var
    */
    public $details;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $details)
    {
         $this->details = $details;
    }



    /**
     * Build the message.
     *
     * @return $this
    */
    public function build()
    {
        /* return $this->view('view.name'); */

        return $this->subject('Contact Message')
                    ->view('form.emails.ContactMail');
    }
}


==================================================================

./form/contact-us.blade.php


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

 <section style="padding-top: 60px;">
     <div class="container">
         <div class="row">
             <div class="col-md-6 offset-md-3">
                 <div class="card">
                     <div class="card-header">
                         Contact Us
                     </div>
                     <div class="card-body">

                         @if(Session::has('message_sent'))
                             <div class="alert alert-succes" role="alert">
                                  {{ Session::get('message_sent') }}
                             </div>
                         @endif

                         <form action="{{ route('contact.send') }}" method="POST" enctype="multipart/form-data">

                             @csrf

                             <div class="form-group">
                                 <label for="name">Name</label>
                                 <input type="text" name="name" id="name" class="form-control">
                             </div>

                             <div class="form-group">
                                 <label for="email">Email</label>
                                 <input type="email" name="email" id="email" class="form-control">
                             </div>

                             <div class="form-group">
                                 <label for="phone">Phone</label>
                                 <input type="text" name="phone" id="phone" class="form-control">
                             </div>

                             <div class="form-group">
                                 <label for="msg">Message</label>
                                 <textarea name="message" id="message" class="form-control"></textarea>
                             </div>

                             <button type="submit" class="btn btn-primary float-right">Submit</button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>

./form/emails/Contactmail.blade.php 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

   <div class="container">
        <h1>Contact Message</h1>
        <p>Name    : {{ $details['name'] }}</p>
        <p>Email   : {{ $details['email'] }}</p>
        <p>Phone   : {{ $details['phone'] }}</p>
        <p>Message : {{ $details['message'] }}</p>
   </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>



```
