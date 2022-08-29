<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User as UserModel;



class Users extends Component
{

    use WithPagination;


    public function render()
    {
        $users = UserModel::paginate(5);

        return view('livewire.users', compact('users'));
    }
}
