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
