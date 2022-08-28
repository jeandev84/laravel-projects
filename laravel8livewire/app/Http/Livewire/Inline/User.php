<?php

namespace App\Http\Livewire\Inline;

use Livewire\Component;

class User extends Component
{
    public function render()
    {
        return <<<'blade'
            <div>
                <h1>This is User Component</h1>
            </div>
        blade;
    }
}
