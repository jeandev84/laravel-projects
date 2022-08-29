### Image CRUD

```php 

$ php artisan make:controller Image/StudentController



$ php artisan make:model Student -mf

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

}


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
            $table->string('name');
            // $table->string('email');
            // $table->string('phone');
            $table->string('profile_image')->nullable();
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

$ php artisan migrate || php artisan migrate:refresh


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



# Image CRUD
Route::get('/add-student', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'addStudent'])
   ->name('student.add');


Route::post('/add-student', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'storeStudent'])
    ->name('student.store');


Route::get('/students', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'getStudents'])
    ->name('students.list');


Route::get('/edit-student/{id}', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'editStudent'])
    ->name('student.edit');


Route::post('/update-student/{id}', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'updateStudent'])
    ->name('student.update');


Route::get('/delete-student/{id}', [\App\Http\Controllers\Image\CRUD\StudentController::class, 'deleteStudent'])
    ->name('student.delete');
    
    

```
