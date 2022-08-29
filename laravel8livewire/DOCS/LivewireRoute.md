### Livewire Route 


1. Make a new Livewire component
```php

$ php artisan make:livewire Home

COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Home.php
VIEW:  resources/views/livewire/home.blade.php


<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{

    // Parameter from route /home/{name}
    public $name;



    // It a Hook will be executed before rendering like Middleware
    // It's like constructor of Component
    /*
    public function mount($name)
    {
         $this->name = $name;
    }
    */


    // Optional parameter
    public function mount($name = null)
    {
        $this->name = $name;
    }



    // Render
    public function render()
    {
        return view('livewire.home');
    }
}

./resources/views/livewire/home.blade.php 

<div>
    <h1>This is Home Livewire Component</h1>

    <!-- Show parameter {name} from URL route -->
    Name : {{ $name }}

</div>


// Route::get('/home/{name}', \App\Http\Livewire\Home::class);
Route::get('/home/{name?}', \App\Http\Livewire\Home::class);

```
