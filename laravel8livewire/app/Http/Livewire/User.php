<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User as UserModel;


class User extends Component
{

    public $users;



    public function render()
    {
        $this->users = UserModel::all();

        return view('livewire.user');
    }
}
