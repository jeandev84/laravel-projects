### Livewire CRUD 


```php 

$ php artisan make:model Student -mf

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = "students";

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];
}


$ php artisan migrate

$ php artisan make:factory StudentFactory

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname'  => $this->faker->lastName,
            'email'     => $this->faker->email,
            'phone'     => $this->faker->phoneNumber
        ];
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(100)->create();

        \App\Models\Student::factory(10)->create();
    }
}



$ php artisan db:seed

=============================================================
    CREATE A LIVEWIRE COMPONENT "Students"
============================================================

$ php artisan make:livewire CRUD/Students

COMPONENT CREATED  🤙

CLASS: app/Http/CRUD/Livewire/Students.php
VIEW:  resources/views/livewire/crud/students.blade.php

-------------------------------------------------------------

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    const PerPage = 10;

    protected $table = "students";

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];
}

<?php

namespace App\Http\Livewire\CRUD;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    public $ids;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;



    public function resetInputFields()
    {
         $this->firstname = '';
         $this->lastname  = '';
         $this->email     = '';
         $this->phone     = '';
    }


    public function store()
    {
         $validatedData = $this->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email',
            'phone'     => 'required'
         ]);

         Student::create($validatedData);

         session()->flash('message', 'Student created successfully!');

         $this->resetInputFields();

         $this->emit('studentAdded');
    }


    public function edit($id)
    {
        $student = Student::where('id', $id)->first();

        $this->ids       = $student->id;
        $this->firstname = $student->firstname;
        $this->lastname  = $student->lastname;
        $this->email     = $student->email;
        $this->phone     = $student->phone;
    }


    public function delete($id)
    {
        if ($id) {

            Student::where('id', $id)->delete();

            session()->flash('message', 'Student deleted successfully!');
        }
    }


    public function update()
    {
         $this->validate([
             'firstname' => 'required',
             'lastname'  => 'required',
             'email'     => 'required|email',
             'phone'     => 'required'
         ]);

         if ($this->ids) {

              $student = Student::find($this->ids);
              $student->update([
                  'firstname' => $this->firstname,
                  'lastname'  => $this->lastname,
                  'email'     => $this->email,
                  'phone'     => $this->phone,
              ]);

              session()->flash('message', 'Student updated successfully!');
              $this->resetInputFields();
              $this->emit('studentUpdated');
         }
    }


    public function render()
    {
        $students = Student::orderBy('id', 'desc')->paginate(Student::PerPage);

        return view('livewire.crud.students', compact('students'));
    }
}

./resources/views/livewire/layouts/app.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        nav svg {
            height: 20px;
        }
    </style>
    @livewireStyles
</head>
<body>

    <section>
        <div class="container">
            {{$slot}}
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    @livewireScripts

    <script>

        // Event for adding student
        window.livewire.on('studentAdded', () => {
            $('#addStudentModal').modal('hide')
        })

        // Event for updating student
        window.livewire.on('studentUpdated', () => {
            $('#updateStudentModal').modal('hide')
        })

        /*
        function callEvent(target, callback) {
            window.livewire.on(callback, () => {
                $('#' + target).modal('hide')
            })
        }
       */
    </script>
</body>
</html>


./resources/views/livewire/layouts/crud/students.blade.php
<div>
    <!-- Include Create Student Modal -->
    @include('livewire.crud.create')

    <!-- Include Update Student Modal -->
    @include('livewire.crud.update')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Display errors messages -->
                      @if(Session::has('message'))
                         <div class="alert alert-success">
                             {{ session('message')}}
                         </div>
                      @endif
                    <!-- End Display -->

                    <div class="card">
                        <div class="card-header">
                            <h3>
                                All Students
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                                    Add New Student
                                </button>
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                   <tr>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Email</th>
                                       <th>Phone</th>
                                       <th>Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                   @foreach($students as $student)
                                       <tr>
                                           <td>{{ $student->firstname }}</td>
                                           <td>{{ $student->lastname }}</td>
                                           <td>{{ $student->email }}</td>
                                           <td>{{ $student->phone }}</td>
                                           <td>
                                               <button type="button"
                                                       class="btn btn-info"
                                                       data-toggle="modal"
                                                       data-target="#updateStudentModal"
                                                       wire:click.prevent="edit({{ $student->id }})">
                                                   Edit
                                               </button>

                                               <button type="button"
                                                       class="btn btn-danger"
                                                       wire:click.prevent="delete({{ $student->id }})">
                                                   Delete
                                               </button>
                                           </td>
                                       </tr>
                                   @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            {{$students->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

./resources/views/livewire/layouts/crud/create.blade.php

<!-- Button trigger modal -->
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--    Launch demo modal--}}
{{--</button>--}}

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" wire:model="firstname">
                        @error('firstname')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" wire:model="lastname">
                        @error('lastname')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" wire:model="email">
                        @error('email')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" wire:model="phone">
                        @error('phone')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="store()">Add Student</button>
            </div>
        </div>
    </div>
</div>


./resources/views/livewire/layouts/crud/update.blade.php

<!-- Button trigger modal -->
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--    Launch demo modal--}}
{{--</button>--}}

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id" wire:model="ids">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" wire:model="firstname">
                        @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" wire:model="lastname">
                        @error('lastname')
                           <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" wire:model="email">
                        @error('email')
                           <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" wire:model="phone">
                        @error('phone')
                           <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="update()">Update Student</button>
            </div>
        </div>
    </div>
</div>

# Livewire CRUD System
Route::get('/students', \App\Http\Livewire\CRUD\Students::class);



```
