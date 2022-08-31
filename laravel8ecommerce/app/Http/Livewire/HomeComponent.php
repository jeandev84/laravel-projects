<?php
namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.components.home')->layout('layouts.base');
    }
}
