### Livewire Search With Pagination 


```php 


<?php

namespace App\Http\Livewire\CRUD;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Students extends Component
{
    use WithPagination;

    // properties form
    public $ids;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;

    // property search
    public $searchTerm;


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
        $searchTerm = '%'. $this->searchTerm . '%';

        $students = Student::where('firstname', 'LIKE', $searchTerm)
                           ->orWhere('lastname', 'LIKE', $searchTerm)
                           ->orWhere('email', 'LIKE', $searchTerm)
                           ->orWhere('phone', 'LIKE', $searchTerm)
                           ->orderBy('id', 'desc')
                           ->paginate(Student::PerPage);

        return view('livewire.crud.list', compact('students'));
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    const PerPage = 5;

    protected $table = "students";

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];
}


<div>
    <!-- Include Create Student Modal -->
    @include('livewire.crud.create')

    <!-- Include Update Student Modal -->
    @include('livewire.crud.update')

    <section style="padding-top: 60px;">
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
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>
                                        All Students
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                                            Add New Student
                                        </button>
                                    </h3>
                                </div>
                                <div class="col-md-4">
                                    <input type="text"
                                           class="form-control"
                                           placeholder="Search..."
                                           wire:model="searchTerm"
                                    />
                                </div>
                            </div>
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


```
