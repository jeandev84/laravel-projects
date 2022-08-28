### Livewire Property Binding

```php 
1. Create a livewire component named "Form"

$ php artisan make:livewire Form

 COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Form.php
VIEW:  resources/views/livewire/form.blade.php


2. Binding properties 

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Form extends Component
{

    public $name;
    public $message;
    public $marital_status;
    public $colors = [];
    public $fruit;


    public function render()
    {
        return view('livewire.form');
    }
}



Views: /resources/views/layouts/app.blade.php 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    @livewireStyles
</head>
<body>

    <section>
        <div class="container">
            {{$slot}}
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    @livewireScripts

</body>
</html>


Views: /resources/views/livewire/form.blade.php

<div class="row mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h3>Information</h3>
            </div>
            <div class="card-body">

                <form action="#" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Name</label>
{{--                    <input type="text" wire:model="name" class="form-control"/>--}}
                        {{-- wire:model.debounce.1000ms: will be send request to server after 1s --}}
                        <input type="text" wire:model.debounce.1000ms="name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea wire:model="message" class="form-control"></textarea>
                    </div>


                    <div class="form-group">
                        <div>Marital Status :</div>
                        <div>
                            <label>Single</label>
                            <input type="radio" wire:model="marital_status" value="single">

                            <label>Married</label>
                            <input type="radio" wire:model="marital_status" value="married">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>Favourite Colors:</div>
                        <div>
                            Red    <input type="checkbox" value="red" wire:model="colors">
                            Green  <input type="checkbox" value="green" wire:model="colors">
                            Blue   <input type="checkbox" value="blue" wire:model="colors">
                        </div>
                    </div>

                    <div class="form-group">
                         <div class="">Favourite Fruit:</div>
                         <select wire:model="fruit" id="fruit" class="form-control">
                            <option value="">Select Fruit</option>
                            <option value="apple">Apple</option>
                            <option value="mango">Mango</option>
                            <option value="banana">Banana</option>
                         </select>
                    </div>
                </form>

                <hr>

                <h3>Details: </h3>
                <div class="row">
                    <div class="col-md-12">
                        <div>Name : {{ $name }}</div>
                        <div>Message : {{ $message }}</div>
                        <div>Marital Status : {{ $marital_status }}</div>
                        <div>Favourite Colors: </div>
                        <ul>
                            @foreach($colors as $color)
                               <li>{{ $color }}</li>
                            @endforeach
                        </ul>
                        <div>Favourite Fruit: {{ $fruit }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




```
