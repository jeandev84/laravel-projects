### Send Email ( ex Via Gmail )

```php 

1. Create a mail controller
$ php artisan make:controller MailController

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



2. Create a mail class
$ php artisan make:mail TestGmailMail


<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class TestGmailMail extends Mailable
{

    use Queueable, SerializesModels;


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

        return $this->subject('Test Mail from Jean-Claude Bandam :)')
                    ->view('emails.feedback');
    }
}



3. Configuration Mail Service
./.env

...

MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=4655
MAIL_USERNAME=jeanyao@gmail.com
MAIL_PASSWORD=secret123!
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=jeanyao@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

...

3. Create a views file ./resources/views/emails/feedback.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>Thank You :)</p>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>



4. Add Route ( Send Mail )

Route::get('/send-mail', [MailController::class, 'sendEmail']);

```
