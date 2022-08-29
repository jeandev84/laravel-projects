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
