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
