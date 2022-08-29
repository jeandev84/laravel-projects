### Livewire Database 

```php 

1. Configuration Database  (.env)

...

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=livewiredb
DB_USERNAME=postgres
DB_PASSWORD=123456
...


$ php artisan make:livewire User

COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/User.php
VIEW:  resources/views/livewire/user.blade.php

=======================================================

$ php artisan migrate
$ php artisan db:seed


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


<div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>All Users</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


Route::get('/users', \App\Http\Livewire\User::class);


```
