<?php

namespace App\Http\Controllers\Image\CRUD;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
      public function addStudent()
      {
            return view('imagecrud.students.add');
      }


      public function storeStudent(Request $request): RedirectResponse
      {
           $image = $request->file;
           $student = new Student();
           $student->name = $request->name;

           if ($image) {
               $profileImageName = time() . '.' . $image->extension();
               $image->move(public_path('images/students'), $profileImageName);
               $student->profile_image = $profileImageName;
           }

           if($student->save()) {
               // $image->move(public_path('images/students'), $profileImageName);
           }

           return back()->with('student_added', 'Student record has been inserted');
      }



      public function getStudents()
      {
          $students = Student::all();

          return view('imagecrud.students.list', compact('students'));
      }


      public function editStudent($id)
      {
           $student = Student::find($id);

           return view('imagecrud.students.edit', compact('student'));
      }



      /**
       * @param Request $request
       * @return RedirectResponse
      */
      public function updateStudent(Request $request): RedirectResponse
      {
            $student = Student::find($request->id);
            $student->name = $request->name;
            $image = $request->file; // name of input : <input name="file">

            if ($image) {
                $profileImageName = time() . '.' . $image->extension();
                $image->move(public_path('images/students'), $profileImageName);
                // Before set image name we must be to remove old image name from /public/images/students
                @unlink(public_path(public_path('images/students'). '/'. $student->profile_image));
                $student->profile_image = $profileImageName;
            }

            if($student->save()) {
              // $image->move(public_path('images/students'), $profileImageName);
            }

           return back()->with('student_updated', 'Student updated successfully!');
      }



      /**
       * @param $id
       * @return RedirectResponse
      */
      public function deleteStudent($id): RedirectResponse
      {
           $student = Student::find($id);

           @unlink(public_path('images/students') . '/' . $student->profile_image);

           $student->delete();

           return back()->with('student_deleted', 'Student deleted successfully!');
      }
}
