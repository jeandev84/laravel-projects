### Livewire LifeCycle Hook


```php 

$ php artisan make:livewire Product

 COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Product.php
VIEW:  resources/views/livewire/product.blade.php

==========================================================


<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Product extends Component
{


    /**
     * @var
    */
    public $title;



    /**
     * @var
    */
    public $name;



    /**
     * @var array
    */
    public $infos = [];



    /**
     * @return void
    */
    public function mount()
    {
        $this->infos[] = 'This Application is mounting ...';
    }




    public function hydrate()
    {
        $this->infos[] = 'This Application is hydrating ...';
    }




    public function updating($name, $value)
    {
        $this->infos[] = 'This Application is updating ...';
    }



    public function updated($name, $value)
    {
        $this->infos[] = 'This Application is updated ...';
    }



    public function updatingName()
    {
        $this->infos[] = 'This Application is updating name property ...';
    }



    public function updatedName()
    {
        $this->infos[] = 'This Application is updated name property ...';
    }


    public function render()
    {
        return view('livewire.product');
    }
}


./resources/views/livewire/product.blade.php

<div>

    <form>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text"  wire:model="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" wire:model="name" class="form-control">
        </div>

        <h3>Title: {{ $title }}</h3>
        <h3>Name: {{ $name }}</h3>

        <h3>Lifecycle Hooks Method</h3>

        @foreach($infos as $info)
            <h4>{{ $info }}</h4>
        @endforeach

    </form>
</div>


Route::get('/product', \App\Http\Livewire\Product::class);
```
