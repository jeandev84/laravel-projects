<?php

namespace App\Http\Controllers\Accessor;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
       public function addStudent()
       {
             $student = new Student();
             $student->name  = "Peter";
             $student->email = "PETERjohn@gmail.com";
             $student->phone = "1234567891";

             $student->save();

             return "Record Inserted";
       }


       public function getStudents()
       {
            return Student::all();
       }
}
