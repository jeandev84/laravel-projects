### Livewire Pagination 


```php

$ php artisan make:livewire Users

COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Users.php
VIEW:  resources/views/livewire/users.blade.php

=========================================================
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

========================================================

./resources/views/livewire/users.blade.php 

<div>

    <style>
       nav svg {
           height: 20px;
       }
    </style>

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

                              <!-- Pagination Links -->
                              {{$users->links()}}

                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </section>

</div>

============================================================

Route::get('/all-users', \App\Http\Livewire\Users::class);

```
