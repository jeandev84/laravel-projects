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
