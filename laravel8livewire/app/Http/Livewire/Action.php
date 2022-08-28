<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Action extends Component
{

    public $num1;
    public $num2;
    public $sum;
    public $message;


    /**
     * @param $num1
     * @param $num2
     * @return void
    */
    public function addTwoNumbers($num1, $num2)
    {
        $this->sum = $num1 + $num2;
    }



    /**
     * @param $message
     * @return void
    */
    public function displayMessage($message)
    {
        $this->message = $message;
    }




    /**
     * @return void
    */
    public function getSum()
    {
        $this->sum = $this->num1 + $this->num2;
    }




    /**
     * @return Application|Factory|View|\Illuminate\View\View
    */
    public function render()
    {
        return view('livewire.action');
    }
}
