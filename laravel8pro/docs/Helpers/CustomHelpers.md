### Create Helpers in Laravel


```php 

1. Create a new file ./app/Helpers/functions.php


<?php


if (! function_exists('splitName')) {

    function splitName(string $name) {

        $name = trim($name);

        $nameArray = explode(" ", $name);

        $firstName = $nameArray[0];
        $lastName  = $nameArray[1];

        return [$firstName, $lastName];
    }
}


2. Registry the helpers path inside composer.json ( ./.composer.json )

"autoload": {
   
    ...
    
    "files": [
        "app/Helpers/functions.php"
    ]
    
    ...
},


3. composer dump-autoload -o

4. php artisan make:controller Helpers/DemoController

<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{

      public function getFirstLastName()
      {
           return splitName("Mark John");
      }


      public function useSomeFunctions() {}
}


5. add route for controller


# Helpers functions
Route::get('/get-name', [\App\Http\Controllers\Helpers\DemoController::class, 'getFirstLastName'])
   ->name('get.name');
   
Result:
[Mark, John]
  
```
