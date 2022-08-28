### Livewire Action


```php 

$ php artisan make:livewire Action
COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Action.php
VIEW:  resources/views/livewire/action.blade.php

=================================================================

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



=================================================================

./resources/views/livewire/action.blade.php

<div class="mt-5">
    <div class="row">

        <div class="col-md-12">

            <div id="sum-action" class="form-group">
                <button type="button" class="btn btn-success" wire:click="addTwoNumbers(32, 55)">Sum</button>
                <span id="sum-result" class="mt-3">
                    Sum : {{ $sum }}
                </span>
            </div>

            <form wire:submit.prevent="getSum()">

                <div class="form-group">
                    <label for="num1">Enter Num 1:</label>
                    <input type="text" name="num1" id="num1" wire:model="num1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="num1">Enter Num 2:</label>
                    <input type="text" name="num2" id="num1" wire:model="num2" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>

            <div id=" keydown-action" class="form-group">
                <label for="message">Message</label>
                <textarea wire:keydown.enter="displayMessage($event.target.value)" class="form-control" id="message"></textarea>
                <div id="message">
                    Message : {{ $message }}
                </div>
            </div>

        </div>

    </div>
</div>



Add Action Route :

Route::get('/actions', \App\Http\Livewire\Action::class);

```
