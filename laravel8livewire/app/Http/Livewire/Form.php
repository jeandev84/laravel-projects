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
