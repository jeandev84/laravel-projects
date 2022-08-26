<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function fetchStudents()
    {
         // $students = Student::all();
         // $students = Student::where('id', 3)->get();
         // $students = Student::whereBetween('id', [33, 44])->get();

            $students = Student::whereBetween('id', [33, 44])->orderBy('id', 'DESC')->get();

         return $students;
    }


    protected function fetchAllStudents()
    {
         return Student::all();
    }


    protected function fetchStudentByColumn($column, $value)
    {
         return Student::where($column, $value)->get();
    }


    protected function fetchStudentsBetween($column, array $intervals)
    {
         return Student::whereBetween($column, $intervals)->get();
    }
}
