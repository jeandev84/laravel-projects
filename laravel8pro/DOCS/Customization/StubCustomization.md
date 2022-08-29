### Stub Customization 

```
$ php artisan stub:publish ( will be create a new folder ./stubs with stubs )
$ php artisan make:controller StudentController


./stubs/controller.plain.stub
<?php

namespace {{ namespace }};

use {{ rootNamespace }}Http\Controllers\Controller;
use Illuminate\Http\Request;

class {{ class }} extends Controller
{
       public function create()
       {
            //
       }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentNewStubController extends Controller
{
       public function create()
       {
            //
       }
}



```
