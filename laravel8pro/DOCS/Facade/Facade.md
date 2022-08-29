### Facade 

```php 

1. Create file ./app/PaymentGateway/Payment


<?php
namespace App\PaymentGateway;


/**
 *
*/
class Payment
{
     public static function process()
     {
          echo "Processing the payment";
     }
}


2. Create file ./app/PaymentGateway/PaymentFacade

<?php
namespace App\PaymentGateway;

use Illuminate\Support\Facades\Facade;


/**
 *
*/
class PaymentFacade extends Facade
{

      protected static function getFacadeAccessor()
      {
            return 'payment';
      }
}


3. Create Payment service provider

$ php artisan make:provider PaymentServiceProvider

This previous command will be create ./app/Providers/PaymentServiceProvider.php 


<?php
namespace App\Providers;

use App\PaymentGateway\Payment;
use Illuminate\Support\ServiceProvider;


class PaymentServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
    */
    public function register()
    {
         $this->app->bind('payment', function () {
             return new Payment();
         });
    }



    /**
     * Bootstrap services.
     *
     * @return void
    */
    public function boot()
    {
        //
    }
}


./config/app.php 


return [

    'providers' => [
       ...
       \App\Providers\PaymentServiceProvider::class,
       ...
    ],
    'aliases' => [
        ...
        
        'Payment' => \App\PaymentGateway\PaymentFacade::class,
        
        ....
    ]
];


# Facades (PaymentGateway)

Route::get('/payment', function () {

    return \App\PaymentGateway\Payment::process();
});

```
