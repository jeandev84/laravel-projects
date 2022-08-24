### HTTP Session 

```php 

$ php artisan make:controller SessionController



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
      public function getSessionData(Request $request)
      {
           if ($request->session()->has('name')) {
                echo $request->session()->get('name');
           }else{
                echo "No data in the session";
           }
      }


      public function storeSessionData(Request $request)
      {
           $request->session()->put('name', 'Jennifer');

           echo "Data has been added to the session";
      }



      public function deleteSessionData(Request $request)
      {
           $request->session()->forget('name');

           echo "Data has been removed from the session";
      }
}




# Http Session
Route::get('/session/get', [SessionController::class, 'getSessionData'])
    ->name('session.get');


Route::get('/session/set', [SessionController::class, 'storeSessionData'])
    ->name('session.store');


Route::get('/session/remove', [SessionController::class, 'deleteSessionData'])
    ->name('session.delete');

```
