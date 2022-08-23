<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{

    // property must be public, so it will not work.
    public $name;



    public $fruits;



    /**
     * Create a new component instance.
     *
     * Parse name <x-header name="Surfside Media"/> in the /resources/views/components/header.blade.php
     *
     * @return void
    */
    public function __construct($name, $fruits)
    {
         $this->name = $name;
         $this->fruits = $fruits;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
    */
    public function render()
    {
        return view('components.header');
    }
}
