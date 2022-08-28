### Livewire Form Validation


```php 
$ php artisan make:livewire Contact

 COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Contact.php
VIEW:  resources/views/livewire/contact.blade.php

===========================================================
Add route :

Route::get('/contact', \App\Http\Livewire\Contact::class);


./app/Http/Livewire/Contact.php

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Contact extends Component
{

    public $name;

    public $email;

    public $phone;

    public $message;



    public function updated($fields)
    {
         $this->validateOnly($fields, [
             'name'    => 'required',
             'email'   => 'required|email',
             'phone'   => 'required|digits:10',
             'message' => 'required|min:20'
         ]);
    }



    public function submitForm()
    {
         $this->validate([
             'name'    => 'required',
             'email'   => 'required|email',
             'phone'   => 'required|digits:10',
             'message' => 'required|min:20'
         ]);

         dd($this->name, $this->email, $this->phone, $this->message);
    }



    public function render()
    {
        return view('livewire.contact');
    }
}


./resources/views/livewire/contact.blade.php

<div>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Contact Form</h3>
                        </div>
                        <div class="card-body">

                            <form wire:submit.prevent="submitForm">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" wire:model="name" class="form-control" id="phone">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" wire:model="email" name="email" class="form-control" id="email">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" wire:model="phone" name="phone" class="form-control" id="phone">
                                    @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" wire:model="message" id="message" class="form-control"></textarea>
                                    @error('$message')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button class="btn btn-success" type="submit">Submit</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



```
